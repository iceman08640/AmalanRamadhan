<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Agenda;
use App\Models\Kultum;
use App\Models\Masjid;
use App\Models\Ustadz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateKultumRequest;

class KultumController extends Controller
{
    public function index(Request $request)
    {
        $list_kultum = Kultum::query()
            ->with(['agenda', 'masjid', 'imam', 'kultum', 'kulsub'])
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
                    ->whereColumn('agenda.id', 'kultum.agenda_id')
                    ->limit(1)
            )
            ->paginate(31)
            ->appends(request()->query());

        $list_masjid = Masjid::where('is_active', true)->get();
        $list_agenda = Agenda::whereIn('id', function ($query) {
            $query->select('agenda_id')
                ->from('kultum');
        })->get();

        return view('kultum.index', compact('list_kultum', 'list_masjid', 'list_agenda'));
    }

    public function create()
    {
        $list_masjid = Masjid::where('is_active', true)->get();
        $list_agenda = Agenda::where(['is_active' => true, 'tipe' => 'kultum'])
            ->get()
            ->map(fn($agenda) => [
                'id' => $agenda->id,
                'tgl' => Carbon::parse($agenda->tgl)->translatedFormat('l, d M Y')
            ]);
        $list_ustadz = Ustadz::where('is_active', true)->get();
        return view('kultum.create', compact('list_masjid', 'list_agenda', 'list_ustadz'));
    }

    public function store(CreateKultumRequest $request)
    {
        // cek tgl dan masjid yg diinput apakah available
        if (Kultum::where(['agenda_id' => $request['agenda_id'], 'masjid_id' => $request['masjid_id']])->count() > 0) {
            return Redirect::route('kultum.create')->with(['status' => 'Masjid dan tanggal sudah pernah diinput, gunakan edit saja', 'tipe' => 'danger']);
        }

        $takjil = Kultum::create($request->validated());
        return Redirect::route('kultum.show', $takjil->id)->with('status', 'Daftar imam dan pembicara saved');
    }

    public function show(Kultum $kultum)
    {
        $kultum->load(['imam', 'kultum', 'kulsub'])->get();
        $list_masjid = Masjid::where('is_active', true)->get();
        $list_agenda = Agenda::where(['is_active' => true, 'tipe' => 'kultum'])
            ->get()
            ->map(fn($agenda) => [
                'id' => $agenda->id,
                'tgl' => Carbon::parse($agenda->tgl)->translatedFormat('l, d M Y')
            ]);

        $list_ustadz = Ustadz::where('is_active', true)->get();
        return view('kultum.show', compact('list_masjid', 'list_agenda', 'list_ustadz', 'kultum'));
    }

    public function update(CreateKultumRequest $request, Kultum $kultum)
    {
        // cek jika tgl dan masjid yg diinput berbeda dg data awal
        if ($request->agenda_id != $kultum['agenda_id'] || $request['masjid_id'] != $kultum->masjid_id) {
            // cek tgl dan masjid yg diinput apakah available
            if (Kultum::where(['agenda_id' => $request->agenda_id, 'masjid_id' => $request->masjid_id])->count() > 0) {
                return Redirect::route('kultum.show', $kultum->id)->with(['status' => 'Masjid dan tanggal sudah pernah diinput, gunakan edit saja', 'tipe' => 'danger']);
            }
        }

        $kultum->fill($request->validated());
        $kultum->save();

        return Redirect::route('kultum.show', $kultum->id)->with('status', 'Daftar imam dan pembicara updated');
    }

    public function destroy(Kultum $kultum)
    {
        $kultum->delete();
        return Redirect::back()->with('status', 'Daftar imam dan pembicara deleted');
    }
}
