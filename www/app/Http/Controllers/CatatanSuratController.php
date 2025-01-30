<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCatatanSuratRequest;
use App\Models\CatatanSurat;
use App\Models\Masjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CatatanSuratController extends Controller
{
    public function index(Request $request, Masjid $masjid)
    {
        $list_catatan_surat = CatatanSurat::query()
            ->where('masjid_id', $masjid->id)
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('konten', 'like', '%' . $request->search . '%');
            })
            ->paginate(10)->appends(request()->query());

        return view('masjid.catatansurat.index', compact('masjid', 'list_catatan_surat'));
    }

    public function create(Masjid $masjid)
    {
        return view('masjid.catatansurat.create', compact('masjid'));
    }

    public function store(CreateCatatanSuratRequest $request, Masjid $masjid)
    {
        $cSurat = CatatanSurat::create(array_merge($request->validated(), ['masjid_id' => $masjid->id]));
        return Redirect::route('catatan-surat.show', [$masjid->id, $cSurat->id])->with('status', 'Catatan surat saved');
    }

    public function show(Masjid $masjid, CatatanSurat $catatan_surat)
    {
        return view('masjid.catatansurat.show', compact(
            'masjid',
            'catatan_surat'
        ));
    }

    public function update(CreateCatatanSuratRequest $request, Masjid $masjid, CatatanSurat $catatan_surat)
    {
        $catatan_surat->fill($request->validated());
        $catatan_surat->save();

        return Redirect::route('catatan-surat.show', [$masjid->id, $catatan_surat->id])->with('status', 'Catatan surat updated');
    }

    public function destroy(Masjid $masjid, CatatanSurat $catatan_surat)
    {
        $catatan_surat->delete();
        return Redirect::back()->with('status', 'Catatan surat deleted');
    }
}
