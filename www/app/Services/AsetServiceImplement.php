<?php

namespace App\Services;

use App\Models\Aset;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AsetServiceImplement implements AsetService
{
    public function store($request_file, $judul)
    {
        try {
            $hash_aset_name = $request_file->hashName();
            $request_file->storeAs('private', $hash_aset_name);

            $new_aset = Aset::create([
                'judul' => $judul,
                'file' => $hash_aset_name,
                'extension' => strtoupper($request_file->getClientOriginalExtension())
            ]);

            return ['status' => 'success', 'message' => $new_aset->id];
        } catch (Throwable $th) {
            return ['status' => 'error', 'message' => 'Gagal menyimpan aset: ' . $th->getMessage()];
        }
    }

    public function update($request_file, $id)
    {
        try {
            $aset = Aset::findOrFail($id);

            Storage::delete('private/' . basename($aset->file));

            $hash_aset_name = $request_file->hashName();
            $request_file->storeAs('private', $hash_aset_name);

            $aset->file = $hash_aset_name;

            $aset->extension = strtoupper($request_file->getClientOriginalExtension());
            $aset->save();

            return ['status' => 'success', 'message' => $aset->id];
        } catch (Throwable $th) {
            return ['status' => 'error', 'message' => 'Gagal memperbarui aset: ' . $th->getMessage()];
        }
    }

    public function destroy($id)
    {
        try {
            $aset = Aset::findOrFail($id);

            $filePath = 'private/' . $aset->file;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            $aset->delete();

            return ['status' => 'success', 'message' => $id];
        } catch (Throwable $th) {
            return ['status' => 'error', 'message' => 'Gagal menghapus aset: ' . $th->getMessage()];
        }
    }
}
