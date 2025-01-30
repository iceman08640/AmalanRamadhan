<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\AsetService;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateMasjidRequest;

class MasjidController extends Controller
{
    public function __construct(
        private AsetService $asetService
    ) {
        $this->asetService = $asetService;
    }

    public function index(Request $request)
    {
        $list_masjid = Masjid::query()
            ->withCount(['catatanSurat'])
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('nama', 'like', '%' . $request->search . '%');
            })
            ->paginate(10)->appends(request()->query());

        return view('masjid.index', compact('list_masjid'));
    }

    public function create()
    {
        $list_masjid = Masjid::where('is_active', true)->get();
        return view('masjid.create', compact('list_masjid'));
    }

    public function store(CreateMasjidRequest $request)
    {
        $validatedData = $request->validated();

        // Cek apakah ada file cap yang dibawa
        if ($request->hasFile('cap')) {
            // Simpan file baru
            $storeResponse = $this->asetService->store($request->file('cap'), "Cap {$request->nama}");
            if ($storeResponse['status'] === 'success') {
                $validatedData['cap_aset_id'] = $storeResponse['message']; // Dapatkan aset_id baru
            } else {
                // Jika gagal, throw exception agar rollback
                throw new \Exception($storeResponse['message']);
            }
        }

        // Cek apakah ada file ttd yang dibawa
        if ($request->hasFile('ttd')) {
            // Simpan file baru
            $storeResponse = $this->asetService->store($request->file('ttd'), "Ttd. {$request->nama}");
            if ($storeResponse['status'] === 'success') {
                $validatedData['ttd_aset_id'] = $storeResponse['message']; // Dapatkan aset_id baru
            } else {
                // Jika gagal, throw exception agar rollback
                throw new \Exception($storeResponse['message']);
            }
        }

        $validatedData = Arr::except($validatedData, ['cap', 'ttd']);
        $masjid = Masjid::create($validatedData);
        return Redirect::route('masjid.show', $masjid->id)->with('status', 'Masjid saved');
    }

    public function show(Masjid $masjid)
    {
        return view('masjid.show', compact(
            'masjid'
        ));
    }

    public function update(CreateMasjidRequest $request, Masjid $masjid)
    {
        $validatedData = $request->validated();

        // Cek apakah ada file cap yang dibawa
        if ($request->hasFile('cap')) {
            // Jika cap_aset_id sebelumnya null, simpan aset baru
            if ($masjid->cap_aset_id === null) {
                // Simpan file baru
                $storeResponse = $this->asetService->store($request->file('cap'), "Cap {$request->nama}");
                if ($storeResponse['status'] === 'success') {
                    $validatedData['cap_aset_id'] = $storeResponse['message']; // Dapatkan aset_id baru
                } else {
                    // Jika gagal, throw exception agar rollback
                    throw new \Exception($storeResponse['message']);
                }
            } else {
                // Jika cap_aset_id tidak null, perbarui aset yang ada
                $updateResponse = $this->asetService->update($request->file('cap'), $masjid->cap_aset_id);
                if ($updateResponse['status'] === 'success') {
                    $validatedData['cap_aset_id'] = $updateResponse['message']; // Tetap gunakan aset_id yang diperbarui
                } else {
                    // Jika gagal, throw exception agar rollback
                    throw new \Exception($updateResponse['message']);
                }
            }
        }

        // Cek apakah ada file ttd yang dibawa
        if ($request->hasFile('ttd')) {
            if ($masjid->ttd_aset_id === null) {
                // Simpan file baru
                $storeResponse = $this->asetService->store($request->file('ttd'), "Ttd. {$request->nama}");
                if ($storeResponse['status'] === 'success') {
                    $validatedData['ttd_aset_id'] = $storeResponse['message']; // Dapatkan aset_id baru
                } else {
                    // Jika gagal, throw exception agar rollback
                    throw new \Exception($storeResponse['message']);
                }
            } else {
                // Jika ttd_aset_id tidak null, perbarui aset yang ada
                $updateResponse = $this->asetService->update($request->file('ttd'), $masjid->ttd_aset_id);
                if ($updateResponse['status'] === 'success') {
                    $validatedData['ttd_aset_id'] = $updateResponse['message']; // Tetap gunakan aset_id yang diperbarui
                } else {
                    // Jika gagal, throw exception agar rollback
                    throw new \Exception($updateResponse['message']);
                }
            }
        }

        $validatedData = Arr::except($validatedData, ['cap', 'ttd']);
        $masjid->fill($validatedData);
        $masjid->save();

        return Redirect::route('masjid.show', $masjid->id)->with('status', 'Masjid updated');
    }

    public function destroy(Masjid $masjid)
    {
        // cek jika ada catatan surat
        if ($masjid->catatanSurat()->count()) return Redirect::back()->with(['status' => 'Gagal dihapus, pastikan masjid tidak memiliki data catatan surat yang terhubung.', 'tipe' => 'danger']);

        // hapus asset cap
        if ($masjid->cap_aset_id != null) $this->asetService->destroy($masjid->cap_aset_id);
        // hapus asset ttd
        if ($masjid->ttd_aset_id != null) $this->asetService->destroy($masjid->ttd_aset_id);

        $masjid->delete();
        return Redirect::back()->with('status', 'Masjid deleted');
    }
}
