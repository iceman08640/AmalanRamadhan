<!DOCTYPE html>
<html>

<head>
    <title>Daftar Ustadz</title>
    <style>
        .text-align-center {
            text-align: center !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        .qr-code {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .qr-code img {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            display: block;
        }
    </style>
</head>

<body>
    <h3 class="text-align-center">Daftar Ustadz</h3>
    <table>
        <thead>
            <tr>
                <th class="text-align-center">No</th>
                <th class="text-align-center">Nama</th>
                <th class="text-align-center">Alamat</th>
                <th class="text-align-center">No. Telp</th>
                <th class="text-align-center">URL Maps</th>
                <th class="text-align-center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ustadz as $item)
                <tr>
                    <td class="text-align-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telp }}<br />
                        <div class="qr-code">{!! $item->qr_no_telp !!}</div>
                    </td>
                    <td><a href="{{ $item->url_maps }}" target="_blank">{{ $item->url_maps }}</a><br />
                        <div class="qr-code">{!! $item->qr_url_maps !!}</div>
                    </td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-align-center">
                        Tidak ada data.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
