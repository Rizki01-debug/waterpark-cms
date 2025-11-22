<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Waterpark</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            color: #333;
            font-size: 12px;
        }
        h2, h3 {
            text-align: center;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background: #0d6efd;
            color: white;
            text-align: center;
            padding: 6px;
        }
        td {
            padding: 6px;
            text-align: center;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 11px;
            color: #555;
        }
    </style>
</head>
<body>

    <h2>Laporan Transaksi Waterpark CMS</h2>
    <h3>Periode: {{ \Carbon\Carbon::parse($start)->format('d M Y') }} - {{ \Carbon\Carbon::parse($end)->format('d M Y') }}</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_pemesan }}</td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data transaksi untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>

</body>
</html>
