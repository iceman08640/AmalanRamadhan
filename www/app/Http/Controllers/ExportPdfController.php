<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Masjid;
use App\Models\Takjil;
use App\Models\Ustadz;
use App\Services\ExportPdfService;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ExportPdfDownloadRequest;

class ExportPdfController extends Controller
{
    public function __construct(private ExportPdfService $exportPdfService)
    {
        $this->exportPdfService = $exportPdfService;
    }

    public function downloadUstadz()
    {
        return $this->exportPdfService->downloadUstadz();
    }

    public function index()
    {
        $list_masjid = Masjid::where('is_active', true)->get();
        $list_agenda = Agenda::where('is_active', true)
            ->select(['id', 'tgl', 'waktu', 'is_takbiran']) // Pilih kolom yang relevan
            ->distinct('tgl', 'waktu') // Ambil data unik berdasarkan tgl dan waktu
            ->get()
            ->map(fn($agenda) => [
                'id' => $agenda->id,
                'tgl' => hariTanggalWaktuIndoTakjil($agenda->tgl, $agenda->is_takbiran, $agenda->waktu),
            ])->unique('tgl');
        $list_ustadz = Ustadz::where('is_active', true)->get();
        $list_warga = Takjil::query()
            ->select('nama')
            ->with(['agenda' => function ($query) {
                $query->where('is_active', true);
            }])
            ->whereHas('agenda', function ($query) {
                $query->where('is_active', true);
            })
            ->groupBy('nama')
            ->get();

        return view('exportpdf.index', compact('list_masjid', 'list_agenda', 'list_ustadz', 'list_warga'));
    }

    public function download(ExportPdfDownloadRequest $request)
    {
        if ($request->mode == 'blangko_kosong' && $request->tipe == 'kultum' && $request->masjid_id != null && $request->agenda_id == null &&  $request->ustadz_id == null && $request->nama_warga == null) {
            // generate blangko kosong kultum masjid
            return $this->exportPdfService->blangkoKosongKultumMasjid($request->masjid_id);
        }

        if ($request->mode == 'blangko_kosong' && $request->tipe == 'takjil' && $request->masjid_id != null && $request->agenda_id == null &&  $request->ustadz_id == null && $request->nama_warga == null) {
            // generate blangko kosong kultum masjid
            return $this->exportPdfService->blangkoKosongTakjilMasjid($request->masjid_id);
        }

        if ($request->mode == 'lembar_permohonan' && $request->tipe == 'kultum' && $request->masjid_id != null && ($request->agenda_id != null || $request->ustadz_id != null) && $request->nama_warga == null) {
            // generate lembar permohonan kultum masjid berdasarkan agenda_id atau ustadz_id
            return $this->exportPdfService->permohonaKultumMasjidByAgendaOrUstadz(
                $request->masjid_id,
                $request->agenda_id,
                $request->ustadz_id
            );
        }

        if ($request->mode == 'jadwal' && $request->tipe == 'kultum' && $request->masjid_id != null && $request->agenda_id == null &&  $request->ustadz_id == null && $request->nama_warga == null) {
            // generate jadwal kultum masjid
            return $this->exportPdfService->jadwalKultumMasjid($request->masjid_id);
        }

        if ($request->mode == 'lembar_permohonan' && $request->tipe == 'kultum' && $request->masjid_id != null && $request->agenda_id == null &&  $request->ustadz_id == null && $request->nama_warga == null) {
            // generate lembar permohonan kultum semua ustadz masjid
            return $this->exportPdfService->permohonanKultumMasjid($request->masjid_id);
        }


        if ($request->mode == 'jadwal' && $request->tipe == 'takjil' && $request->masjid_id != null && $request->agenda_id == null &&  $request->ustadz_id == null && $request->nama_warga == null) {
            // generate jadwal takjil masjid
            return $this->exportPdfService->jadwalTakjilMasjid($request->masjid_id);
        }

        if ($request->mode == 'lembar_permohonan' && $request->tipe == 'takjil' && $request->masjid_id != null && $request->agenda_id == null &&  $request->ustadz_id == null && $request->nama_warga == null) {
            // generate lembar permohonan takjil semua warga masjid
            return $this->exportPdfService->permohonanTakjilMasjid($request->masjid_id, $request->is_include_lampiran);
        }

        if ($request->mode == 'lembar_permohonan' && $request->tipe == 'takjil' && $request->masjid_id != null && ($request->agenda_id != null || $request->nama_warga != null) && $request->ustadz_id == null) {
            // generate lembar permohonan tajil masjid berdasarkan agenda_id atau nama warga
            return $this->exportPdfService->permohonaTakjilMasjidByAgendaOrNamaWarga(
                $request->masjid_id,
                $request->agenda_id,
                $request->nama_warga,
                $request->is_include_lampiran
            );
        }

        // jika diluar jangkauan
        return Redirect::back()->with(['status' => 'Kombinasi inputan tidak cocok', 'tipe' => 'danger']);
    }
}
