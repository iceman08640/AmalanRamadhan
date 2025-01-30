<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Takjil;
use App\Models\Agenda;
use App\Models\Masjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateDaftarTakjilRequest;

class TakjilController extends Controller
{
    public function index(Request $request)
    {
        $list_takjil = Takjil::query()
            ->with(['agenda', 'masjid'])
            ->when(!blank($request->masjid), function ($query) use ($request) {
                return $query->whereHas('masjid', function ($q) use ($request) {
                    $q->where('id', $request->masjid);
                });
            })
            ->when(!blank($request->tanggal), function ($query) use ($request) {
                return $query->whereHas('agenda', function ($q) use ($request) {
                    $q->where('id', $request->tanggal);
                });
            })
            ->orderBy(
                Agenda::select('tgl')
                    ->whereColumn('agenda.id', 'takjil.agenda_id')
                    ->limit(1)
            )
            ->paginate(30)
            ->appends(request()->query());

        $list_masjid = Masjid::where('is_active', true)->get();
        $list_agenda = Agenda::whereIn('id', function ($query) {
            $query->select('agenda_id')
                ->from('takjil');
        })->get();

        return view('takjil.index', compact('list_takjil', 'list_masjid', 'list_agenda'));
    }

    public function create()
    {
        $list_masjid = Masjid::where('is_active', true)->get();
        $list_agenda =
            Agenda::where(['is_active' => true, 'tipe' => 'takjil'])
            ->get()
            ->map(fn($agenda) => [
                'id' => $agenda->id,
                'tgl' => hariTanggalWaktuIndoTakjil($agenda->tgl, $agenda->is_takbiran, $agenda->waktu)
            ]);
        return view('takjil.create', compact('list_masjid', 'list_agenda'));
    }

    public function store(CreateDaftarTakjilRequest $request)
    {
        $takjil = Takjil::create($request->validated());
        return Redirect::route('takjil.show', $takjil->id)->with('status', 'Takjil saved');
    }

    public function show(Takjil $takjil)
    {
        $list_masjid = Masjid::where('is_active', true)->get();
        $list_agenda =
            Agenda::where(['is_active' => true, 'tipe' => 'takjil'])
            ->get()
            ->map(fn($agenda) => [
                'id' => $agenda->id,
                'tgl' => Carbon::parse($agenda->tgl)->translatedFormat('l, d M Y') .
                    ($agenda->is_takbiran && $agenda->waktu
                        ? ' - Takbiran, ' . Carbon::parse($agenda->waktu)->translatedFormat('H:i')
                        : '')
            ]);
        return view('takjil.show', compact('list_masjid', 'list_agenda', 'takjil'));
    }

    public function update(CreateDaftarTakjilRequest $request, Takjil $takjil)
    {
        $takjil->fill($request->validated());
        $takjil->save();

        return Redirect::route('takjil.show', $takjil->id)->with('status', 'Takjil updated');
    }

    public function destroy(Takjil $takjil)
    {
        $takjil->delete();
        return Redirect::back()->with('status', 'Takjil deleted');
    }
}
