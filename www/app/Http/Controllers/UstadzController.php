<?php

namespace App\Http\Controllers;

use App\Models\Ustadz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateUstadzRequest;

class UstadzController extends Controller
{
    public function index(Request $request)
    {
        $list_ustadz = Ustadz::query()
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('nama', 'like', '%' . $request->search . '%');
            })
            ->paginate(10)->appends(request()->query());

        return view('ustadz.index', compact('list_ustadz'));
    }

    public function create()
    {
        return view('ustadz.create');
    }

    public function store(CreateUstadzRequest $request)
    {
        $ustadz = Ustadz::create($request->validated());
        return Redirect::route('ustadz.show', $ustadz->id)->with('status', 'Ustadz saved');
    }

    public function show(Ustadz $ustadz)
    {
        return view('ustadz.show', compact(
            'ustadz'
        ));
    }

    public function update(CreateUstadzRequest $request, Ustadz $ustadz)
    {
        $ustadz->fill($request->validated());
        $ustadz->save();

        return Redirect::route('ustadz.show', $ustadz->id)->with('status', 'Ustadz updated');
    }

    public function destroy(Ustadz $ustadz)
    {
        // cek jika ada kultum
        if ($ustadz->kultum()->count()) return Redirect::back()->with(['status' => 'Gagal dihapus, pastikan ustadz tidak memiliki data kultum yang terhubung.', 'tipe' => 'danger']);

        $ustadz->delete();
        return Redirect::back()->with('status', 'Ustadz deleted');
    }
}
