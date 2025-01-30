<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Support\Facades\Storage;

class AsetController extends Controller
{
    /**
     * Display the specified aset.
     */
    public function show(Aset $aset)
    {
        // Cek apakah file ada di storage
        if (!Storage::disk('local')->exists('private/' . $aset->file)) {
            return abort(404, 'File tidak ditemukan.');
        }

        // Path file dalam storage
        $file_path = storage_path('app/private/' . $aset->file);

        // Tambahkan header yang diperlukan
        return response()->file($file_path, [
            'Access-Control-Expose-Headers' => '*',
            'Content-Type' => $aset->extension,
            'Content-Disposition' => 'inline; filename="' . $aset->judul . '"'
        ])->setStatusCode(200);
    }
}
