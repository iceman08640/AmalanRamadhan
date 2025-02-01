<?php

namespace App\Services;

use App\Models\Agenda;
use App\Models\Kultum;
use App\Models\Masjid;
use App\Models\Takjil;
use App\Models\CatatanSurat;
use App\Models\Ustadz;
use BaconQrCode\Writer;
use Barryvdh\DomPDF\Facade\Pdf;
use BaconQrCode\Renderer\ImageRenderer;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

class ExportPdfServiceImplement implements ExportPdfService
{
    private function _generateQrCode($data)
    {
        // Jika data null, kembalikan null
        if (is_null($data)) {
            return null;
        }

        $renderer = new ImageRenderer(
            new RendererStyle(200), // Ukuran QR code
            new SvgImageBackEnd()   // Format SVG
        );
        $writer = new Writer($renderer);
        return $writer->writeString($data); // Hasilkan QR code dalam format SVG
    }

    public function downloadUstadz()
    {
        // Ambil semua data ustadz
        $ustadz = Ustadz::all();

        // Generate QR code untuk setiap ustadz
        foreach ($ustadz as $item) {
            $item->qr_no_telp = $this->_generateQrCode($item->no_telp); // QR code untuk no_telp
            $item->qr_url_maps = $this->_generateQrCode($item->url_maps); // QR code untuk url_maps
        }

        // Membuat view untuk PDF
        // $pdf = Pdf::loadView('pdf.ustadz', compact('ustadz'));

        // // Prepare nama file
        // $nama_file = "DaftarUstadz-" . tglWktIndoWithDash(getNowDateTimeString());

        // // Kembalikan PDF yang sudah dibuat
        // return $pdf->stream($nama_file . '.pdf');

        // Kembaliakan sebagai html biasa saja
        return view('pdf.ustadz', compact('ustadz'));
    }

    public function blangkoKosongTakjilMasjid($masjid_id)
    {
        // Ambil data agenda
        $list_agenda = Agenda::where(['is_active' => true, 'tipe' => 'takjil'])->orderBy('tgl')->get();

        // Cek dulu apakah ada agenda yg aktif
        if ($list_agenda->count() < 1) {
            return Redirect::back()->with(['status' => 'Tidak ada tanggal aktif yang bisa digunakan', 'tipe' => 'danger']);
        }

        // Ambil data masjidnya
        $masjid = Masjid::find($masjid_id);

        // Prepare nama file
        $nama_file = "BlangkoKosongTakjil" . $masjid->nama . '-' . tglWktIndoWithDash(getNowDateTimeString());

        $pdf = Pdf::loadView('pdf.jadwal.blangkotakjil', compact('nama_file', 'masjid', 'list_agenda'));
        return $pdf->stream("{$nama_file}.pdf");
    }
    public function blangkoKosongKultumMasjid($masjid_id)
    {
        // Ambil data agenda
        $list_agenda = Agenda::where(['is_active' => true, 'tipe' => 'kultum'])->orderBy('tgl')->get();

        // Cek dulu apakah ada agenda yg aktif
        if ($list_agenda->count() < 1) {
            return Redirect::back()->with(['status' => 'Tidak ada tanggal aktif yang bisa digunakan', 'tipe' => 'danger']);
        }

        // Ambil data masjidnya
        $masjid = Masjid::find($masjid_id);

        // Prepare nama file
        $nama_file = "BlangkoKosongKultum" . $masjid->nama . '-' . tglWktIndoWithDash(getNowDateTimeString());

        $pdf = Pdf::loadView('pdf.jadwal.blangkokultum', compact('nama_file', 'masjid', 'list_agenda'));
        return $pdf->stream("{$nama_file}.pdf");
    }

    public function jadwalKultumMasjid($masjid_id)
    {
        // Cek dulu masjid punya jadwal kultum apa tidak
        $rowCount = Kultum::where('masjid_id', $masjid_id)->count();
        if ($rowCount < 1) {
            return Redirect::back()->with(['status' => 'Masjid tidak memiliki jadwal kultum', 'tipe' => 'danger']);
        }

        // Ambil data masjidnya
        $masjid = Masjid::find($masjid_id);

        // Ambil jadwal berdasarkan masjid yg dipilih
        $list_kultum = Kultum::with(['agenda', 'masjid', 'imam', 'kultum', 'kulsub'])
            ->whereHas('masjid', function ($query) use ($masjid_id) {
                $query->where('id', $masjid_id);
            })
            ->orderBy(
                Agenda::select('tgl')
                    ->whereColumn('agenda.id', 'kultum.agenda_id')
                    ->limit(1)
            )
            ->get();

        // Prepare nama file
        $nama_file = "JadwalKultum" . $masjid->nama . '-' . tglWktIndoWithDash(getNowDateTimeString());

        $pdf = Pdf::loadView('pdf.jadwal.kultum', compact('nama_file', 'masjid', 'list_kultum'));
        return $pdf->stream("{$nama_file}.pdf");
    }

    public function permohonaKultumMasjidByAgendaOrUstadz($masjid_id, $agenda_id = null, $ustadz_id = null)
    {
        // Cek dulu masjid punya jadwal kultum apa tidak
        $rowCount = Kultum::where('masjid_id', $masjid_id)->count();
        if ($rowCount < 1) {
            return Redirect::back()->with(['status' => 'Masjid tidak memiliki jadwal kultum', 'tipe' => 'danger']);
        }

        // Ambil data masjidnya
        $masjid = Masjid::with([
            'capAset' => function ($query) {
                $query->limit(1);
            },
            'ttdAset' => function ($query) {
                $query->limit(1);
            }
        ])->find($masjid_id);

        // Mengambil catatan surat yang aktif dan terbaru dengan tipe kultum
        $catatanSurat = CatatanSurat::where('masjid_id', $masjid_id)
            ->where('tipe', 'kultum')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->first();
        $masjid->catatanSurat = $catatanSurat;

        // Ambil ustadz distinct berdasarkan masjid yang dipilih
        $list_ustadz = Kultum::with(['imam', 'kultum', 'kulsub', 'agenda'])
            ->whereHas('masjid', function ($query) use ($masjid_id) {
                $query->where('id', $masjid_id); // Filter berdasarkan masjid_id
            })
            ->when($ustadz_id, function ($query) use ($ustadz_id) {
                // Jika ustadz_id tidak null, filter berdasarkan imam_ustadz_id, kultum_ustadz_id, atau kulsub_ustadz_id
                $query->where(function ($q) use ($ustadz_id) {
                    $q->whereHas('imam', function ($q) use ($ustadz_id) {
                        $q->where('imam_ustadz_id', $ustadz_id);
                    })
                        ->orWhereHas('kultum', function ($q) use ($ustadz_id) {
                            $q->where('kultum_ustadz_id', $ustadz_id);
                        })
                        ->orWhereHas('kulsub', function ($q) use ($ustadz_id) {
                            $q->where('kulsub_ustadz_id', $ustadz_id);
                        });
                });
            })
            ->when($agenda_id, function ($query) use ($agenda_id) {
                // Jika agenda_id tidak null, filter berdasarkan agenda_id
                $query->whereHas('agenda', function ($q) use ($agenda_id) {
                    $q->where('agenda_id', $agenda_id);
                });
            })
            ->get()
            ->flatMap(function ($kultum) use ($ustadz_id) {
                // Ambil data ustadz dari imam, kultum, dan kulsub
                return collect([$kultum->imam, $kultum->kultum, $kultum->kulsub])
                    ->filter(function ($ustadz) use ($ustadz_id) {
                        // Jika ustadz_id tidak null, filter berdasarkan ustadz_id
                        if ($ustadz_id) {
                            return $ustadz && $ustadz->id == $ustadz_id;
                        }
                        // Jika ustadz_id null, ambil semua data ustadz
                        return $ustadz !== null;
                    });
            })
            ->unique('id'); // Ambil data ustadz yang unik berdasarkan id

        // Ambil jadwal berdasarkan masjid yg dipilih
        $list_kultum = Kultum::with(['agenda', 'masjid', 'imam', 'kultum', 'kulsub'])
            ->whereHas('masjid', function ($query) use ($masjid_id) {
                $query->where('id', $masjid_id);
            })
            ->orderBy(
                Agenda::select('tgl')
                    ->whereColumn('agenda.id', 'kultum.agenda_id')
                    ->limit(1)
            )
            ->get();

        // Prepare nama file
        $nama_file = "LembarPermohonanKultum-" . tglWktIndoWithDash(getNowDateTimeString());

        // Render PDF
        $pdf = Pdf::loadView('pdf.lembarpermohonan.kultum', compact('nama_file', 'masjid', 'list_ustadz', 'list_kultum'));
        return $pdf->stream("{$nama_file}.pdf");
    }

    public function permohonaTakjilMasjidByAgendaOrNamaWarga($masjid_id, $agenda_id = null, $nama_warga = null, $is_include_lampiran)
    {
        // Cek dulu masjid punya jadwal takjil apa tidak
        $rowCount = Takjil::where('masjid_id', $masjid_id)->count();
        if ($rowCount < 1) {
            return Redirect::back()->with(['status' => 'Masjid tidak memiliki jadwal takjil', 'tipe' => 'danger']);
        }

        // Ambil data masjidnya
        $masjid = Masjid::with([
            'capAset' => function ($query) {
                $query->limit(1);
            },
            'ttdAset' => function ($query) {
                $query->limit(1);
            }
        ])->find($masjid_id);

        // Mengambil catatan surat yang aktif dan terbaru dengan tipe takjil
        $catatanSurat = CatatanSurat::where('masjid_id', $masjid_id)
            ->where('tipe', 'takjil')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->first();
        $masjid->catatanSurat = $catatanSurat;

        // Ambil warga distinct berdasarkan masjid yg dipilih
        $list_warga = Takjil::where('masjid_id', $masjid_id)
            ->when($agenda_id, function ($query) use ($agenda_id) {
                // Jika agenda_id tidak null, filter berdasarkan agenda_id
                $query->where('agenda_id', $agenda_id);
            })
            ->when($nama_warga, function ($query) use ($nama_warga) {
                // Jika nama_warga tidak null, filter berdasarkan nama_warga (kolom 'nama')
                $query->where('nama', 'like', '%' . $nama_warga . '%');
            })
            ->select('nama')
            ->distinct()
            ->get();

        // Ambil jadwal berdasarkan masjid yg dipilih
        $list_takjil = Takjil::with(['agenda', 'masjid'])
            ->whereHas('masjid', function ($query) use ($masjid_id) {
                $query->where('id', $masjid_id);
            })
            ->orderBy(
                Agenda::select('tgl')
                    ->whereColumn('agenda.id', 'takjil.agenda_id')
                    ->limit(1)
            )
            ->get();

        // Prepare nama file
        $nama_file = "LembarPermohonanTakjil" . $masjid->nama . '-' . tglWktIndoWithDash(getNowDateTimeString());

        $pdf = Pdf::loadView('pdf.lembarpermohonan.takjil', compact('nama_file', 'masjid', 'is_include_lampiran', 'list_warga', 'list_takjil'));
        return $pdf->stream("{$nama_file}.pdf");
    }

    public function jadwalTakjilMasjid($masjid_id)
    {
        // Cek dulu masjid punya jadwal takjil apa tidak
        $rowCount = Takjil::where('masjid_id', $masjid_id)->count();
        if ($rowCount < 1) {
            return Redirect::back()->with(['status' => 'Masjid tidak memiliki jadwal takjil', 'tipe' => 'danger']);
        }

        // Ambil data masjidnya
        $masjid = Masjid::find($masjid_id);

        // Ambil jadwal berdasarkan masjid yg dipilih
        $list_takjil = Takjil::with(['agenda', 'masjid'])
            ->whereHas('masjid', function ($query) use ($masjid_id) {
                $query->where('id', $masjid_id);
            })
            ->orderBy(
                Agenda::select('tgl')
                    ->whereColumn('agenda.id', 'takjil.agenda_id')
                    ->limit(1)
            )
            ->get();

        // Prepare nama file
        $nama_file = "JadwalTakjil" . $masjid->nama . '-' . tglWktIndoWithDash(getNowDateTimeString());

        $pdf = Pdf::loadView('pdf.jadwal.takjil', compact('nama_file', 'masjid', 'list_takjil'));
        return $pdf->stream("{$nama_file}.pdf");
    }

    public function permohonanKultumMasjid($masjid_id)
    {
        // Cek dulu masjid punya jadwal kultum apa tidak
        $rowCount = Kultum::where('masjid_id', $masjid_id)->count();
        if ($rowCount < 1) {
            return Redirect::back()->with(['status' => 'Masjid tidak memiliki jadwal kultum', 'tipe' => 'danger']);
        }

        // Ambil data masjidnya
        $masjid = Masjid::with([
            'capAset' => function ($query) {
                $query->limit(1);
            },
            'ttdAset' => function ($query) {
                $query->limit(1);
            }
        ])->find($masjid_id);

        // Mengambil catatan surat yang aktif dan terbaru dengan tipe kultum
        $catatanSurat = CatatanSurat::where('masjid_id', $masjid_id)
            ->where('tipe', 'kultum')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->first();
        $masjid->catatanSurat = $catatanSurat;

        // Ambil ustadz distinct berdasarkan masjid yg dipilih
        $list_ustadz = Kultum::with(['imam', 'kultum', 'kulsub'])
            ->whereHas('masjid', function ($query) use ($masjid_id) {
                $query->where('id', $masjid_id);
            })
            ->get()
            ->flatMap(function ($kultum) {
                return [
                    $kultum->imam,
                    $kultum->kultum,
                    $kultum->kulsub
                ];
            })
            ->filter(function ($ustadz) {
                return $ustadz !== null;
            })
            ->unique('id');

        // Ambil jadwal berdasarkan masjid yg dipilih
        $list_kultum = Kultum::with(['agenda', 'masjid', 'imam', 'kultum', 'kulsub'])
            ->whereHas('masjid', function ($query) use ($masjid_id) {
                $query->where('id', $masjid_id);
            })
            ->orderBy(
                Agenda::select('tgl')
                    ->whereColumn('agenda.id', 'kultum.agenda_id')
                    ->limit(1)
            )
            ->get();

        // Prepare nama file
        $nama_file = "LembarPermohonanKultum" . $masjid->nama . '-' . tglWktIndoWithDash(getNowDateTimeString());

        $pdf = Pdf::loadView('pdf.lembarpermohonan.kultum', compact('nama_file', 'masjid', 'list_ustadz', 'list_kultum'));
        return $pdf->stream("{$nama_file}.pdf");
    }

    public function permohonanTakjilMasjid($masjid_id, $is_include_lampiran)
    {
        // Cek dulu masjid punya jadwal takjil apa tidak
        $rowCount = Takjil::where('masjid_id', $masjid_id)->count();
        if ($rowCount < 1) {
            return Redirect::back()->with(['status' => 'Masjid tidak memiliki jadwal takjil', 'tipe' => 'danger']);
        }

        // Ambil data masjidnya
        $masjid = Masjid::with([
            'capAset' => function ($query) {
                $query->limit(1);
            },
            'ttdAset' => function ($query) {
                $query->limit(1);
            }
        ])->find($masjid_id);

        // Mengambil catatan surat yang aktif dan terbaru dengan tipe takjil
        $catatanSurat = CatatanSurat::where('masjid_id', $masjid_id)
            ->where('tipe', 'takjil')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->first();
        $masjid->catatanSurat = $catatanSurat;

        // Ambil warga distinct berdasarkan masjid yg dipilih
        $list_warga = Takjil::where('masjid_id', $masjid_id)
            ->select('nama')
            ->distinct()
            ->get();

        // Ambil jadwal berdasarkan masjid yg dipilih
        $list_takjil = Takjil::with(['agenda', 'masjid'])
            ->whereHas('masjid', function ($query) use ($masjid_id) {
                $query->where('id', $masjid_id);
            })
            ->orderBy(
                Agenda::select('tgl')
                    ->whereColumn('agenda.id', 'takjil.agenda_id')
                    ->limit(1)
            )
            ->get();

        // Prepare nama file
        $nama_file = "LembarPermohonanTakjil" . $masjid->nama . '-' . tglWktIndoWithDash(getNowDateTimeString());

        $pdf = Pdf::loadView('pdf.lembarpermohonan.takjil', compact('nama_file', 'masjid', 'is_include_lampiran', 'list_warga', 'list_takjil'));
        return $pdf->stream("{$nama_file}.pdf");
    }
}
