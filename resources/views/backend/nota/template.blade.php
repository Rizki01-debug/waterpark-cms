<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pemesanan #{{ $pemesanan->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
        }
        .info {
            margin-bottom: 20px;
        }
        .info table {
            width: 100%;
            border-collapse: collapse;
        }
        .info th, .info td {
            text-align: left;
            padding: 5px 0;
        }
        .summary {
            border-top: 2px solid #333;
            padding-top: 10px;
            margin-top: 20px;
            font-size: 14px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 13px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Embun Pelangi Waterpark</h2>
        <p><strong>Nota Pemesanan</strong></p>
    </div>

    <div class="info">
        <table>
            <tr>
                <th>ID Pemesanan</th>
                <td>#{{ $pemesanan->id }}</td>
            </tr>
            <tr>
                <th>Nama Pemesan</th>
                <td>{{ $pemesanan->nama_pemesan }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $pemesanan->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>{{ $pemesanan->telepon ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ ucfirst($pemesanan->kategori) }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $pemesanan->status }}</td>
            </tr>
            <tr>
                <th>Tanggal Pemesanan</th>
                <td>{{ $pemesanan->created_at->format('d M Y H:i') }}</td>
            </tr>
        </table>
    </div>

    <div class="summary">
        <p><strong>Total Pembayaran:</strong> Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</p>
        <p><em>Terima kasih telah melakukan pemesanan</em></p>
    </div>

    <div class="footer">
        <p>Dicetak otomatis oleh sistem Waterpark CMS</p>
    </div>
</body>
</html>
