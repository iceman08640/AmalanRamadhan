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

        .table-warga {
            border: none !important;
            width: 100%;
            word-wrap: break-word;
        }

        .table-warga table {
            border-collapse: collapse;
            width: 100%;
        }

        .table-warga td {
            text-align: left;
            padding: 2px;
            max-width: 150px;
            overflow-wrap: break-word;
        }

        .table-jadwal {
            width: 100%;
        }

        .table-jadwal table {
            border: 1px solid #c7c7c7;
            border-collapse: collapse;
            width: 100% !important;
            word-wrap: break-word;
        }

        .table-jadwal th,
        .table-jadwal td {
            border: 1px solid #c7c7c7;
            text-align: left;
            padding: 1.5px;
            page-break-inside: avoid;
        }

        .table-jadwal th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .table-jadwal td {
            max-width: 150px;
            overflow-wrap: break-word;
        }

        .table-jadwal tr {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    @foreach ($list_warga as $warga)
        @php
            // Ambil jadwal untuk warga ini
            $jadwal_warga = $list_takjil->where('nama', $warga->nama);

            // Init kelompok
            $kelompok = 'Pribadi';

            if ($jadwal_warga->isNotEmpty()) {
                // Ambil agenda_id dari jadwal_warga
                $agenda_id_warga = $jadwal_warga->pluck('agenda_id');

                // Ambil data yang memiliki agenda_id yang sama
                $kelompok = $list_takjil->whereIn('agenda_id', $agenda_id_warga);

                // Modifikasi nama warga tertentu dengan <mark>
                $kelompok =
                    $kelompok->count() > 1
                        ? $kelompok
                            ->pluck('nama')
                            ->map(function ($nama) use ($warga) {
                                return $nama === $warga->nama ? "<mark>$nama</mark>" : $nama;
                            })
                            ->implode(' | ')
                        : 'Pribadi';
            }
        @endphp
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
                    {{ tanggalIndo(getNowDateTimeString()) }}</p>
            </div>

            <!-- Nomor dan Lampiran di Kiri -->
            <div class="nomor-lampiran" style="padding-bottom: 20px;">
                <p>Nomor : &nbsp; &nbsp; / {{ getRomanMonth() }} / {{ strtoupper($masjid->nama) }} /
                    {{ date('Y') }}</p>
                <p>Perihal : Pemberitahuan</p>
            </div>

            <!-- "Kepada Yth" di Kanan -->
            <div class="to-whom">
                <p>Kepada Yth:</p>
                <p class="font-weight-bold">{{ $warga->nama }}</p>
                <p>di Tempat.</p>
            </div>

            <!-- Clearfix untuk membersihkan float -->
            <div class="clearfix"></div>

            <p><strong>Assalamu’alaikum Wr. Wb.</strong></p>

            <p>Puji syukur Alhamdulillah kita haturkan kehadirat Allah SWT, karena sampai saat ini kita masih
                diperkenankan bertemu dengan Bulan Suci Ramadhan {{ getCurrentHijriYear() }}
                H / {{ date('Y') }} M, bulan yang sangat kita nanti-natikan
                kehadirannya. Selanjutnya dengan ini kami atas nama Ta’mirul Masjid {{ $masjid->nama }} bermaksud
                memohon bantuan
                konsumsi untuk kegiatan buka bersama pada :</p>

            <div class="table-warga">
                <table>
                    <tr>
                        <td width="10%">Hari/Tanggal</td>
                        <td width="1%">:</td>
                        <td class="font-weight-bold">{{ hariIndoSyariah($jadwal_warga->first()?->agenda->tgl) }},
                            {{ tanggalIndo($jadwal_warga->first()?->agenda->tgl) }}</td>
                    </tr>
                    @if ($jadwal_warga->first()?->agenda->is_takbiran)
                        <tr>
                            <td width="10%">Waktu</td>
                            <td width="1%">:</td>
                            <td class="font-weight-bold">{{ wktIndo($jadwal_warga->first()?->agenda->waktu) }}
                                (Takbiran)
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td width="10%">Kelompok</td>
                        <td width="1%">:</td>
                        <td>{!! $kelompok !!}</td>
                    </tr>
                </table>
            </div>

            <p>Demikian permohonan dan pemberitahuan ini disampaikan. Atas keihklasan dan kesediaan Bapak/Ibu kami
                ucapkan terima kasih. Semoga menjadikan amal jariyah bagi Bapak/Ibu. <i>Aamiin.</i></p>

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

        @if ($is_include_lampiran)
            <!-- Lampiran jadwal -->
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
                <p class="text-align-center font-weight-bold" style="margin-top: -15px;">JADWAL TAKJIL
                    {{ getCurrentHijriYear() }} H / {{ date('Y') }} M</p>
                <div class="table-jadwal">
                    <table>
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="10%">HARI</th>
                                <th width="15%">TANGGAL</th>
                                <th>NAMA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Kelompokkan data berdasarkan tanggal
                                $groupedByDate = $list_takjil->groupBy(function ($item) {
                                    return $item->agenda->tgl;
                                });
                                $no = 1;
                            @endphp

                            @foreach ($groupedByDate->sortBy(function ($item, $key) {
        return \Carbon\Carbon::parse($key);
    }) as $date => $takjilsByDate)
                                @php
                                    $day = hariIndoSyariah($date);
                                    // Kelompokkan data berdasarkan waktu di dalam setiap tanggal
                                    $groupedByTime = $takjilsByDate->groupBy(function ($item) {
                                        return $item->agenda->waktu;
                                    });
                                @endphp

                                <tr>
                                    <td class="text-align-center">
                                        @if ($takjilsByDate->pluck('nama')->contains($warga->nama))
                                            <mark>{{ $no++ }}</mark>
                                        @else
                                            {{ $no++ }}
                                        @endif
                                    </td>
                                    <td class="text-align-center">
                                        @if ($takjilsByDate->pluck('nama')->contains($warga->nama))
                                            <mark>{{ $day }}</mark>
                                        @else
                                            {{ $day }}
                                        @endif
                                    </td>
                                    <td class="text-align-center">
                                        @if ($takjilsByDate->pluck('nama')->contains($warga->nama))
                                            <mark>{{ tglIndo($date) }}</mark>
                                        @else
                                            {{ tglIndo($date) }}
                                        @endif
                                    </td>
                                    <td style="padding-left: 9px;">
                                        @foreach ($groupedByTime as $time => $takjils)
                                            @if ($time)
                                                <strong>Jam {{ wktIndo($time) }}</strong><br>
                                            @endif

                                            {{-- Gabungkan nama dengan separator menggunakan Arr::join --}}
                                            {!! Arr::join(
                                                $takjils->pluck('nama')->map(function ($nama) use ($warga) {
                                                        return $nama === $warga->nama ? "<mark>$nama</mark>" : $nama;
                                                    })->toArray(),
                                                ' | ',
                                            ) !!}<br>

                                            {{-- Tambahkan pembatas horizontal jika bukan waktu terakhir --}}
                                            @if (!$loop->last)
                                                <hr style="border: 0.5px solid #c7c7c7; margin: 6px 0 2px -7px;">
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>

</html>
