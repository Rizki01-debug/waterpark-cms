<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pembelian Tiket</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { color: #1e88e5; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Waterpark CMS - Nota Pembelian</h2>
    <table>
        <tr><th>Nama Pemesan</th><td>{{ $pemesanan->nama_pemesan }}</td></tr>
        <tr><th>Email</th><td>{{ $pemesanan->email ?? '-' }}</td></tr>
        <tr><th>Telepon</th><td>{{ $pemesanan->telepon ?? '-' }}</td></tr>
        <tr><th>Kategori</th><td>{{ ucfirst($pemesanan->kategori) }}</td></tr>
        <tr><th>Total</th><td>Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</td></tr>
        <tr><th>Status</th><td>{{ $pemesanan->status }}</td></tr>
        <tr><th>Tanggal</th><td>{{ $pemesanan->created_at->format('d M Y, H:i') }}</td></tr>
    </table>
    <p style="margin-top:30px;">Terima kasih telah memesan tiket di Waterpark CMS!</p>
</body>
</html>
