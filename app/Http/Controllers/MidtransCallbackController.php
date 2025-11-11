<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');

        // 🔒 Validasi signature agar callback sah dari Midtrans
        $hashed = hash('sha512', 
            $request->order_id . 
            $request->status_code . 
            $request->gross_amount . 
            $serverKey
        );

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // 🔍 Temukan pesanan berdasarkan order_id dari Midtrans
        $pemesanan = Pemesanan::where('midtrans_order_id', $request->order_id)->first();

        if (!$pemesanan) {
            return response()->json(['message' => 'Pemesanan tidak ditemukan'], 404);
        }

        // 💰 Jika pembayaran sukses (settlement/capture)
        if (in_array($request->transaction_status, ['capture', 'settlement'])) {
            $pemesanan->status = 'Berhasil';

            // 🔹 Buat folder penyimpanan nota jika belum ada
            if (!Storage::disk('public')->exists('nota')) {
                Storage::disk('public')->makeDirectory('nota');
            }

            // 🔹 Generate nota PDF dari view resources/views/user/nota.blade.php
            $pdf = Pdf::loadView('user.nota', ['pemesanan' => $pemesanan]);
            $fileName = 'nota_' . $pemesanan->id . '.pdf';
            $path = 'nota/' . $fileName;

            // 🔹 Simpan file ke storage/public/nota
            Storage::disk('public')->put($path, $pdf->output());

            // 🔹 Simpan path ke database
            $pemesanan->nota_path = $path;
            $pemesanan->save();

            return response()->json(['message' => 'Pembayaran berhasil & nota dibuat']);
        }

        // ❌ Jika dibatalkan, ditolak, atau kadaluarsa
        if (in_array($request->transaction_status, ['cancel', 'deny', 'expire'])) {
            $pemesanan->status = 'Batal';
            $pemesanan->save();

            return response()->json(['message' => 'Transaksi dibatalkan']);
        }

        // ⏳ Jika masih pending
        if ($request->transaction_status === 'pending') {
            $pemesanan->status = 'Pending';
            $pemesanan->save();

            return response()->json(['message' => 'Transaksi masih pending']);
        }

        return response()->json(['message' => 'Callback processed']);
    }
}
