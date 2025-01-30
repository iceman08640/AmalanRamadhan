<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Agenda;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateAgendaRequest;
use App\Http\Requests\CreateAgendaQuickModeRequest;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $list_agenda = Agenda::query()
            ->when(!blank($request->tipe), function ($query) use ($request) {
                return $query
                    ->where('tipe', $request->tipe);
            })->orderBy('tgl')
            ->paginate(31)->appends(request()->query());

        return view('agenda.index', compact('list_agenda'));
    }

    public function createQuickMode()
    {
        return view('agenda.createquickmode');
    }

    public function storeQuickMode(CreateAgendaQuickModeRequest $request)
    {
        // Init tgl start dan end
        $tglStart = $request->tgl_start;
        $tglEnd = $request->tgl_end;

        // Fungsi untuk mengecek duplikasi tanggal jika bukan takbiran
        $checkDuplicateDate = function ($tgl, $tipe) {
            return Agenda::where('tgl', $tgl)
                ->where('tipe', $tipe)
                ->where('is_takbiran', false) // Hanya cek jika bukan takbiran
                ->exists();
        };

        // Mengubah $tglStart dan $tglEnd menjadi format Carbon untuk iterasi
        $currentDate = Carbon::parse($tglStart);
        $endDate = Carbon::parse($tglEnd);

        // Looping dari tgl_start hingga tgl_end
        while ($currentDate->lte($endDate)) {
            $data['tgl'] = $currentDate->toDateString();

            // Cek duplikasi untuk takjil
            if (!$checkDuplicateDate($data['tgl'], 'takjil')) {
                Agenda::create([
                    'tgl' => $data['tgl'],
                    'waktu' => null,
                    'is_takbiran' => false,
                    'tipe' => 'takjil',
                    'is_active' => true,
                ]);
            }

            // Cek duplikasi untuk kultum
            if (!$checkDuplicateDate($data['tgl'], 'kultum')) {
                Agenda::create([
                    'tgl' => $data['tgl'],
                    'waktu' => null,
                    'tipe' => 'kultum',
                    'is_active' => true,
                ]);
            } else {
                // Jika duplikasi ditemukan, skip atau lakukan penanganan lain
            }

            // Lanjutkan ke tanggal berikutnya
            $currentDate->addDay();
        }

        // Menambahkan satu record kultum untuk tgl_start - 1 hari
        $previousDate = Carbon::parse($tglStart)->subDay();
        Agenda::create([
            'tgl' => $previousDate->toDateString(),
            'waktu' => null,
            'tipe' => 'kultum',
            'is_active' => true,
        ]);

        // Menambahkan satu record untuk malam takbiran di tgl_end
        Agenda::create([
            'tgl' => $tglEnd,
            'waktu' => '20:00:00',
            'is_takbiran' => true,
            'tipe' => 'takjil',
            'is_active' => true,
        ]);

        return Redirect::route('agenda.index')->with('status', 'Generate mulai tanggal ' . tglIndo($tglStart) . ' berakhir tanggal ' . tglIndo($tglEnd) . ' selesai');
    }
    public function create()
    {
        return view('agenda.create');
    }

    public function store(CreateAgendaRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            // Fungsi untuk mengecek duplikasi tanggal jika bukan takbiran
            $checkDuplicateDate = function ($tgl, $tipe) {
                return Agenda::where('tgl', $tgl)
                    ->where('tipe', $tipe)
                    ->where('is_takbiran', false) // Hanya cek jika bukan takbiran
                    ->exists();
            };

            if ($data['is_takjil'] && $data['is_kultum']) {
                // Cek duplikasi untuk takjil
                if (!$data['is_malam_takbir'] && $checkDuplicateDate($data['tgl'], 'takjil')) {
                    throw new \Exception('Tanggal untuk agenda takjil sudah ada.');
                }

                // Cek duplikasi untuk kultum
                if (!$data['is_malam_takbir'] && $checkDuplicateDate($data['tgl'], 'kultum')) {
                    throw new \Exception('Tanggal untuk agenda kultum sudah ada.');
                }

                Agenda::create([
                    'tgl' => $data['tgl'],
                    'waktu' => $data['waktu'] ?? null,
                    'is_takbiran' => $data['is_malam_takbir'],
                    'tipe' => 'takjil',
                    'is_active' => $data['is_active'] ?? true,
                ]);

                Agenda::create([
                    'tgl' => $data['tgl'],
                    'waktu' => null,
                    'tipe' => 'kultum',
                    'is_active' => $data['is_active'] ?? true,
                ]);
            } elseif ($data['is_takjil']) {
                // Cek duplikasi untuk takjil
                if (!$data['is_malam_takbir'] && $checkDuplicateDate($data['tgl'], 'takjil')) {
                    throw new \Exception('Tanggal untuk agenda takjil sudah ada.');
                }

                Agenda::create([
                    'tgl' => $data['tgl'],
                    'waktu' => $data['waktu'] ?? null,
                    'is_takbiran' => $data['is_malam_takbir'],
                    'tipe' => 'takjil',
                    'is_active' => $data['is_active'] ?? true,
                ]);
            } elseif ($data['is_kultum']) {
                // Cek duplikasi untuk kultum
                if (!$data['is_malam_takbir'] && $checkDuplicateDate($data['tgl'], 'kultum')) {
                    throw new \Exception('Tanggal untuk agenda kultum sudah ada.');
                }

                Agenda::create([
                    'tgl' => $data['tgl'],
                    'waktu' => null,
                    'tipe' => 'kultum',
                    'is_active' => $data['is_active'] ?? true,
                ]);
            }

            DB::commit();
            return Redirect::route('agenda.index')->with('status', 'Agenda berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function show(Agenda $agenda)
    {
        return view('agenda.show', compact('agenda'));
    }

    public function update(CreateAgendaRequest $request, Agenda $agenda)
    {
        $validatedData = $request->validated();

        // Fungsi untuk mengecek duplikasi tanggal jika bukan takbiran
        $checkDuplicateDate = function ($tgl, $tipe) {
            return Agenda::where('tgl', $tgl)
                ->where('tipe', $tipe)
                ->where('is_takbiran', false) // Hanya cek jika bukan takbiran
                ->exists();
        };

        if ($validatedData['is_malam_takbir'] === true) {
            // jika takjil, set is_takbiran sebagai true
            $validatedData['is_takbiran'] = true;
            $validatedData = Arr::except($validatedData, ['is_malam_takbir']);
        } else {
            // Cek duplikasi untuk takjil jika tidak malam takbir
            if (isset($validatedData['is_takjil']) && $validatedData['is_takjil'] && !$validatedData['is_malam_takbir']) {
                if ($checkDuplicateDate($validatedData['tgl'], 'takjil')) {
                    return Redirect::back()->with('error', 'Tanggal untuk agenda takjil sudah ada.');
                }
            }

            // Cek duplikasi untuk kultum jika tidak malam takbir
            if (isset($validatedData['is_kultum']) && $validatedData['is_kultum'] && !$validatedData['is_malam_takbir']) {
                if ($checkDuplicateDate($validatedData['tgl'], 'kultum')) {
                    return Redirect::back()->with('error', 'Tanggal untuk agenda kultum sudah ada.');
                }
            }

            // Hapus is_malam_takbir karena sudah diproses
            $validatedData = Arr::except($validatedData, ['is_malam_takbir']);
        }

        // Update agenda dengan data yang telah divalidasi
        $agenda->fill($validatedData);
        $agenda->save();

        return Redirect::route('agenda.show', $agenda->id)->with('status', 'Agenda updated');
    }

    public function destroy(Agenda $agenda)
    {
        // cek jika ada kultum
        if ($agenda->kultum()->count()) return Redirect::back()->with(['status' => 'Gagal dihapus, pastikan agenda tidak memiliki data kultum yang terhubung.', 'tipe' => 'danger']);
        // cek jika ada takjil
        if ($agenda->takjil()->count()) return Redirect::back()->with(['status' => 'Gagal dihapus, pastikan agenda tidak memiliki data takjil yang terhubung.', 'tipe' => 'danger']);

        $agenda->delete();
        return Redirect::back()->with('status', 'Agenda deleted');
    }
}
