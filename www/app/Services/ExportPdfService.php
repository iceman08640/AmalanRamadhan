<?php

namespace App\Services;

interface ExportPdfService
{
    /**
     * list ustadz with qr code for url_maps and nomer HP/WA
     */
    public function downloadUstadz();

    /**
     * generate blangko jadwal kultum masjid
     * @param uuid masjid id
     */
    public function blangkoKosongKultumMasjid($masjid_id);

    /**
     * generate blangko jadwal takjil masjid
     * @param uuid masjid id
     */
    public function blangkoKosongTakjilMasjid($masjid_id);

    /**
     * generate jadwal kultum masjid
     * @param uuid masjid id
     */
    public function jadwalKultumMasjid($masjid_id);

    /**
     * generate lembar permohonan kultum masjid berdasarkan tanggal atau ustadz
     * @param uuid masjid id
     * @param uuid agenda id
     * @param uuid ustadz id
     */
    public function permohonaKultumMasjidByAgendaOrUstadz($masjid_id, $agenda_id, $ustadz_id);

    /**
     * generate lembar permohonan takjil masjid berdasarkan tanggal atau nama warga
     * @param uuid masjid id
     * @param uuid agenda id
     * @param uuid ustadz id
     */
    public function permohonaKultumMasjidByAgendaOrNamaWarga($masjid_id, $agenda_id, $nama_warga, $is_include_lampiran);

    /**
     * generate jadwal takjil masjid
     * @param uuid masjid id
     */
    public function jadwalTakjilMasjid($masjid_id);

    /**
     * generate lembar permohonan kultum masjid
     * @param uuid masjid id
     */
    public function permohonanKultumMasjid($masjid_id);

    /**
     * generate lembar permohonan takjil masjid
     * @param uuid masjid id
     */
    public function permohonanTakjilMasjid($masjid_id, $is_include_lampiran);
}
