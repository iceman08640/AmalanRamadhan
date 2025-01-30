<?php

/**
 * generate datetime now
 * @return string 2023-10-19 13:37:09
 */
function getNowDateTimeString()
{
    return \Carbon\Carbon::now()->toDateTimeString();
}

/**
 * generate carbon date time now
 */
function getNowDateTimeCarbon()
{
    return \Carbon\Carbon::now();
}


/**
 * generate hari indo dari date y-m-d
 * @return string Senin
 */
function hariIndo($date)
{
    return \Carbon\Carbon::parse($date)->translatedFormat('l');
}

/**
 * generate hari indo dari date y-m-d
 * @return string Senin
 */
function hariIndoSyariah($date)
{
    $hari = \Carbon\Carbon::parse($date)->translatedFormat('l');
    $hariSyariah = $hari == 'Minggu' ? 'Ahad' : $hari;
    return $hariSyariah;
}

/**
 * generate hari indo dari datetime
 * @return string Jan
 */
function blnIndo($date)
{
    return \Carbon\Carbon::parse($date)->translatedFormat('M');
}

/**
 * generate hari indo dari datetime
 * @return string Januari
 */
function bulanIndo($date)
{
    return \Carbon\Carbon::parse($date)->translatedFormat('F');
}

/**
 * generate "hari, tanggal jam:menit" indo lengkap
 * @return string Kamis, 23 Oktober 2023 20:21
 */
function hariTanggalWaktuIndo($date)
{
    $hari = hariIndoSyariah($date);
    $tglJam =  \Carbon\Carbon::parse($date)->translatedFormat('d F Y H:i');
    return $hari . ', ' . $tglJam;
}

/**
 * generate "hari, tanggal jam:menit" indo lengkap
 * @return string Kamis, 23 Oktober 2023 20:21
 */
function hariTanggalWaktuIndoTakjil($tgl, $is_takbiran, $waktu)
{
    $hari = hariIndoSyariah($tgl);
    $tglJamIsTakbiran = \Carbon\Carbon::parse($tgl)->translatedFormat('d M Y') . ($is_takbiran && $waktu
        ? ' - Takbiran, ' . \Carbon\Carbon::parse($waktu)->translatedFormat('H:i')
        : '');

    return $hari . ', ' . $tglJamIsTakbiran;
}

/**
 * generate "hari, tanggal" indo lengkap
 * @return string Kamis, 23 Oktober 2023
 */
function hariTanggalIndo($date)
{
    return \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y');
}

/**
 * generate tanggal indo lengkap
 * @return string 23 Oktober 2023
 */
function tanggalIndo($date)
{
    return \Carbon\Carbon::parse($date)->translatedFormat('d F Y');
}

/**
 * generate tanggal indo lengkap
 * @return string 23 Okt 2023
 */
function tglIndo($date)
{
    return \Carbon\Carbon::parse($date)->translatedFormat('d M Y');
}

/**
 * generate waktu indo lengkap
 * @return string 23:12:45
 */
function waktuIndo($date)
{
    return \Carbon\Carbon::parse($date)->translatedFormat('H:i:s');
}

/**
 * generate waktu indo
 * @return string 23:12
 */
function wktIndo($date)
{
    return \Carbon\Carbon::parse($date)->translatedFormat('H:i');
}

/**
 * generate tgl-waktu tanpa pemisah
 * @return string 23Okt23-231245
 */
function tglWktIndoWithDash($date)
{
    return \Carbon\Carbon::parse($date)->translatedFormat('dMY-His');
}

/**
 * Mengubah boolean menjadi ya/tidak
 * @return string YA atau TIDAK
 */
function convertBooleanToYaTidak($bool)
{
    return $bool == true ? 'Ya' : 'Tidak';
}

/**
 * Get angka romawi bulan saat ini
 * @return string I II IV
 */
function getRomanMonth()
{
    return ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'][date('n') - 1];
}

/**
 * Get tahun Hijriah saat ini
 * @return string Tahun Hijriah (misal: 1446)
 */
function getCurrentHijriYear(): string
{
    // Tanggal saat ini
    $currentDate = new DateTime();

    // Konversi tanggal Masehi ke tanggal Hijriah
    $hijriYear = gregorianToHijri($currentDate->format('Y'), $currentDate->format('m'), $currentDate->format('d'));

    // Kembalikan tahun Hijriah sebagai string
    return $hijriYear['year'];
}

/**
 * Fungsi untuk mengkonversi tanggal Masehi ke tanggal Hijriah.
 * Menggunakan algoritma konversi yang akurat.
 */
function gregorianToHijri(int $year, int $month, int $day): array
{
    // Jika bulan kurang dari 3, kurangi tahun karena tahun Hijriah dimulai dari bulan Juli
    if ($month < 3) {
        $year -= 1;
        $month += 12;
    }

    // Hitung nilai konversi
    $a = floor($year / 100);
    $b = 2 - $a + floor($a / 4);
    $jd = floor(365.25 * ($year + 4716)) + floor(30.6001 * ($month + 1)) + $day + $b - 1524;

    // Hitung tanggal Hijriah
    $l = $jd - 1948440 + 10632;
    $n = floor(($l - 1) / 10631);
    $l = $l - 10631 * $n + 354;
    $j = (floor((10985 - $l) / 5316)) * (floor((50 * $l) / 17719)) + (floor($l / 5670)) * (floor((43 * $l) / 15238));
    $l = $l - (floor((30 - $j) / 15)) * (floor((17719 * $j) / 50)) - (floor($j / 16)) * (floor((15238 * $j) / 43)) + 29;
    $month = floor((24 * $l) / 709);
    $day = $l - floor((709 * $month) / 24);
    $year = 30 * $n + $j - 30;

    return [
        'year' => $year,
        'month' => $month,
        'day' => $day,
    ];
}
