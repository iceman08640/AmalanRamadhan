<?php

use App\Models\Identitas;
use App\Constant\IdentitasConst;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\TakjilController;
use App\Http\Controllers\UstadzController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\KultumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExportPdfController;
use App\Http\Controllers\CatatanSuratController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/assets/{aset}', [AsetController::class, 'show'])->name('aset.show');

Route::permanentRedirect('/', '/login');

Route::middleware('auth', 'web', 'permission')->group(function () {
    Route::get('/dashboard', function () {
        $identitas = Identitas::find(IdentitasConst::ID);
        return view('dashboard.dashboard', compact('identitas'));
    })->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('agenda/quick-mode', [AgendaController::class, 'createQuickMode'])->name('agenda.create.quick.mode');
    Route::post('agenda/quick-mode', [AgendaController::class, 'storeQuickMode'])->name('agenda.store.quick.mode');
    Route::resource('agenda', AgendaController::class)->except(['edit']);

    Route::resource('masjid', MasjidController::class)->except(['edit', 'update']);
    Route::post('/masjid/{masjid}', [MasjidController::class, 'update'])->name('masjid.update');
    Route::resource('masjid/{masjid}/catatan-surat', CatatanSuratController::class)->except(['edit']);

    Route::resource('ustadz', UstadzController::class)->except(['edit']);
    Route::resource('takjil', TakjilController::class)->except(['edit']);
    Route::resource('kultum', KultumController::class)->except(['edit']);

    Route::get('export-pdf/ustadz', [ExportPdfController::class, 'downloadUstadz'])->name('exportpdf.ustadz.download');
    Route::get('export-pdf', [ExportPdfController::class, 'index'])->name('exportpdf.index');
    Route::post('export-pdf', [ExportPdfController::class, 'download'])->name('exportpdf.download');
});

require __DIR__ . '/auth.php';
