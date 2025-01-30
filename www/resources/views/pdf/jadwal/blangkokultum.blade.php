<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $nama_file }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0.2cm;
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
            font-size: 14px;
            border: 1px solid #c7c7c7;
            border-collapse: collapse;
            width: 100%;
            word-wrap: break-word;
        }

        th {
            border: 1px solid #c7c7c7;
            text-align: left;
            padding: 1.5px;
            page-break-inside: avoid;
        }

        td {
            border: 1px solid #c7c7c7;
            text-align: left;
            padding: 2px;
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
        <p class="text-align-center font-weight-bold" style="margin-top: -15px;">JADWAL IMAM, KULTUM, KULSUB
            {{ getCurrentHijriYear() }} H / {{ date('Y') }} M</p>
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
                @forelse ($list_agenda as $agenda)
                    <tr>
                        <td class="text-align-center">{{ $loop->iteration }}</td>
                        <td class="text-align-center">{{ hariIndoSyariah($agenda->tgl) }}</td>
                        <td class="text-align-center">{{ tglIndo($agenda->tgl) }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
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
</body>

</html>
