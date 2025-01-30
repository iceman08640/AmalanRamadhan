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

        .content {
            margin-top: 20px;
            line-height: 1.5;
        }

        .content p {
            text-align: justify;
        }

        .text-align-center {
            text-align: center !important;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        table {
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
        <p class="text-align-center font-weight-bold" style="margin-top: -15px;">JADWAL TAKJIL {{ getCurrentHijriYear() }}
            H / {{ date('Y') }} M</p>
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
                            {{ $no++ }}
                        </td>
                        <td class="text-align-center">
                            {{ $day }}
                        </td>
                        <td class="text-align-center">
                            {{ tglIndo($date) }}
                        </td>
                        <td style="padding-left: 9px;">
                            @foreach ($groupedByTime as $time => $takjils)
                                @if ($time)
                                    <strong>Jam {{ wktIndo($time) }}</strong><br>
                                @endif

                                {!! Arr::join($takjils->pluck('nama')->toArray(), ' | ') !!}<br>

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
</body>

</html>
