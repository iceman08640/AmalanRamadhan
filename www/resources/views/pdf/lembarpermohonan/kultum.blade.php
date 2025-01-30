<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $nama_file }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0.5cm;
            font-size: 15px;
        }

        .header {
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0 0;
        }

        .tanggal-surat {
            margin-top: -15px;
        }

        .tanggal-surat p {
            text-align: right !important;
            margin: 0;
        }

        .content {
            margin-top: 20px;
            line-height: 1.5;
        }

        .content p {
            text-align: justify;
        }

        .alamat-tujuan {
            margin-left: 50%;
        }

        .to-whom {
            margin-top: 20px;
            text-align: right;
        }

        .to-whom p {
            margin: 5px 0;
            line-height: 1;
        }

        .nomor-lampiran {
            text-align: right !important;
            float: left;
            width: 70%;
            line-height: 7px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .footer {
            margin-top: 60px;
            line-height: 19px;
        }

        .signature p {
            text-align: center !important;
            margin-bottom: 40px;
        }

        .signature {
            margin-top: 20px;
            text-align: center;
            float: right;
            width: 40%;
            margin-left: 20px;
            margin-bottom: 0;
            padding-bottom: 0;
            position: relative;
            height: 4cm;
        }

        .cap-img,
        .ttd-img {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .cap-img {
            z-index: 10;
            width: 4cm;
            height: 4cm;
            top: 50%;
            transform: translateY(-60%) translateX(-75%) rotate(-15deg);
        }

        .ttd-img {
            z-index: 9;
            width: 1.7cm;
            height: 3.1cm;
            top: 50%;
            transform: translateY(-45%) translateX(-50%);
        }

        .ttd-nama-terang {
            margin-top: 10px;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: underline;
        }

        .page-break {
            page-break-before: always;
        }

        .text-align-center {
            text-align: center !important;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        table {
            font-size: 14px;
            border: 1px solid #c7c7c7;
            border-collapse: collapse;
            width: 100%;
            word-wrap: break-word;
        }

        th,
        td {
            border: 1px solid #c7c7c7;
            text-align: left;
            padding: 1.5px;
            page-break-inside: avoid;
        }

        th {
            background-color: #f2f2f2;
            text-align: center
        }

        td {
            max-width: 150px;
            overflow-wrap: break-word;
        }

        tr {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    @foreach ($list_ustadz as $ustadz)
        <!-- Halaman Pertama -->
        <div class="header">
            <h2>TA’MIRUL MASJID {{ strtoupper($masjid->nama) }}</h2>
            <h2>DUKUH {{ strtoupper($masjid->dukuh) }} RT {{ strtoupper($masjid->rt) }} RW {{ strtoupper($masjid->rw) }}
                DESA {{ strtoupper($masjid->desa) }}</h2>
            <h2>KECAMATAN {{ strtoupper($masjid->kecamatan) }} KABUPATEN {{ strtoupper($masjid->kab_kota) }}</h2>
            <p>{{ $masjid->alamat }}</p>
            <hr />
        </div>

        <div class="content">

            <!-- Tanggal di Kanan -->
            <div class="tanggal-surat">
                <p class="text-align-right">{{ Str::ucfirst($masjid->dukuh) }},
                    {{ tanggalIndo(getNowDateTimeString()) }}
                </p>
            </div>

            <!-- Nomor dan Lampiran di Kiri -->
            <div class="nomor-lampiran">
                <p>Nomor : &nbsp; &nbsp; / {{ getRomanMonth() }} / {{ strtoupper($masjid->nama) }} /
                    {{ date('Y') }}</p>
                <p>Lampiran : 1 bendel</p>
                <p>Perihal : Permohonan Menjadi Imam / Pembicara Amaliyah Romadhon</p>
            </div>

            <!-- "Kepada Yth" di Kanan -->
            <div class="to-whom">
                <p>Kepada Yth:</p>
                <p class="font-weight-bold">{{ $ustadz->nama }}</p>
                <p>di Tempat.</p>
            </div>

            <!-- Clearfix untuk membersihkan float -->
            <div class="clearfix"></div>

            <p><strong>Assalamu’alaikum Wr. Wb.</strong></p>

            <p>Puji syukur senantiasa kita panjatkan kehadirat Allah SWT yang telah melimpahkan rahmat dan hidayah-Nya
                kepada kita semua. Sholawat dan salam semoga senantiasa tercurah kepada junjungan kita Nabi Muhammad SAW
                beserta keluarga, sahabat, dan pengikutnya yang tetap istiqomah pada risalah-Nya.</p>

            <p>Dalam rangka menyemarakkan Bulan Suci Ramadhan serta demi lancarnya syiar Islam, kami Ta’mirul Masjid
                {{ strtoupper($masjid->nama) }} Dk. {{ Str::ucfirst($masjid->dukuh) }} RT {{ $masjid->rt }} RW
                {{ $masjid->rw }}
                Ds. {{ Str::ucfirst($masjid->desa) }} Kec. {{ Str::ucfirst($masjid->kecamatan) }} Kab.
                {{ Str::ucfirst($masjid->kab_kota) }} akan mengadakan
                amaliyah Bulan
                Ramadhan {{ getCurrentHijriYear() }} H yang berupa sholat tarawih, kuliah tujuh menit, dan sholat subuh
                berjamaah
                serta dilanjutkan
                kuliah subuh.</p>

            <p>Sehubung dengan adanya kegiatan Amaliyah Bulan Ramadhan {{ getCurrentHijriYear() }} H /
                {{ date('Y') }}
                M di Masjid
                {{ $masjid->nama }},
                maka dengan
                segala kerendahan hati, kami mengharap partisipasi dari Bapak / Saudara untuk menjadi imam sholat
                tarawih /
                pembicara kultum pada sholat tarawih / pembicara kuliah subuh di Masjid {{ $masjid->nama }}. (jadwal
                terlampir)</p>

            <p><strong>Wassalamu’alaikum Wr. Wb.</strong></p>

            <div class="signature">
                <p>Ta’mirul Masjid {{ $masjid->nama }}</p>
                <img class="cap-img"
                    src="{{ $masjid->capAset ? base_path('/storage/app/private/') . $masjid->capAset->file : '' }}">
                <img class="ttd-img"
                    src="{{ $masjid->ttdAset ? base_path('/storage/app/private/') . $masjid->ttdAset->file : '' }}">
                <p class="ttd-nama-terang">{{ strtoupper($masjid->takmir) }}</p>
            </div>

            <div class="footer">
                @if ($masjid->catatanSurat)
                    {!! $masjid->catatanSurat->konten !!}
                @endif
            </div>

        </div>

        <!-- Halaman Kedua -->
        <div class="page-break"></div>

        <div class="header">
            <h2>TA’MIRUL MASJID {{ strtoupper($masjid->nama) }}</h2>
            <h2>DUKUH {{ strtoupper($masjid->dukuh) }} RT {{ strtoupper($masjid->rt) }} RW
                {{ strtoupper($masjid->rw) }}
                DESA {{ strtoupper($masjid->desa) }}</h2>
            <h2>KECAMATAN {{ strtoupper($masjid->kecamatan) }} KABUPATEN {{ strtoupper($masjid->kab_kota) }}</h2>
            <p>{{ $masjid->alamat }}</p>
            <hr />
        </div>

        <div class="content">
            <p class="text-align-center font-weight-bold" style="margin-top: -15px;">JADWAL IMAM, KULTUM, KULSUB</p>
            <table>
                <thead>
                    <tr>
                        <th width="6%">NO</th>
                        <th width="10%">HARI</th>
                        <th width="14%">TANGGAL</th>
                        <th>IMAM</th>
                        <th>KULTUM</th>
                        <th>KULSUB</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list_kultum as $kultum)
                        <tr>
                            <td class="text-align-center">
                                @if (
                                    ($kultum->imam && $kultum->imam->nama == $ustadz->nama) ||
                                        ($kultum->kultum && $kultum->kultum->nama == $ustadz->nama) ||
                                        ($kultum->kulsub && $kultum->kulsub->nama == $ustadz->nama))
                                    <mark>{{ $loop->iteration }}</mark>
                                @else
                                    {{ $loop->iteration }}
                                @endif
                            </td>
                            <td class="text-align-center">
                                @if (
                                    ($kultum->imam && $kultum->imam->nama == $ustadz->nama) ||
                                        ($kultum->kultum && $kultum->kultum->nama == $ustadz->nama) ||
                                        ($kultum->kulsub && $kultum->kulsub->nama == $ustadz->nama))
                                    <mark>{{ hariIndoSyariah($kultum->agenda->tgl) }}</mark>
                                @else
                                    {{ hariIndoSyariah($kultum->agenda->tgl) }}
                                @endif
                            </td>
                            <td class="text-align-center">
                                @if (
                                    ($kultum->imam && $kultum->imam->nama == $ustadz->nama) ||
                                        ($kultum->kultum && $kultum->kultum->nama == $ustadz->nama) ||
                                        ($kultum->kulsub && $kultum->kulsub->nama == $ustadz->nama))
                                    <mark>{{ tglIndo($kultum->agenda->tgl) }}</mark>
                                @else
                                    {{ tglIndo($kultum->agenda->tgl) }}
                                @endif
                            </td>
                            <td>
                                @if ($kultum->imam && $kultum->imam->nama == $ustadz->nama)
                                    <mark>{{ $kultum->imam->nama }}</mark>
                                @else
                                    {{ $kultum->imam->nama ?? '-' }}
                                @endif
                            </td>
                            <td>
                                @if ($kultum->kultum && $kultum->kultum->nama == $ustadz->nama)
                                    <mark>{{ $kultum->kultum->nama }}</mark>
                                @else
                                    {{ $kultum->kultum->nama ?? '-' }}
                                @endif
                            </td>
                            <td>
                                @if ($kultum->kulsub && $kultum->kulsub->nama == $ustadz->nama)
                                    <mark>{{ $kultum->kulsub->nama }}</mark>
                                @else
                                    {{ $kultum->kulsub->nama ?? '-' }}
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-900 dark:text-white">
                                Tidak ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>

</html>
