<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\ReservasiReguler;
use App\Models\ReservasiPaket;
use App\Models\ReservasiPenginapan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createSnapToken(Request $request)
    {
        $request->validate([
            'tiket_id' => 'required|integer',
            'jenis' => 'required|string|in:reguler,paket,penginapan',
        ]);

        try {
            // 🔹 Ambil data tiket berdasarkan jenis
            switch ($request->jenis) {
                case 'paket':
                    $tiket = ReservasiPaket::findOrFail($request->tiket_id);
                    break;
                case 'penginapan':
                    $tiket = ReservasiPenginapan::findOrFail($request->tiket_id);
                    break;
                default:
                    $tiket = ReservasiReguler::findOrFail($request->tiket_id);
            }

            // 🔹 Hitung harga akhir (jika ada diskon)
            $hargaAkhir = $tiket->diskon > 0
                ? $tiket->harga - ($tiket->harga * $tiket->diskon / 100)
                : $tiket->harga;

            // 🔹 Buat data pemesanan
            $pemesanan = Pemesanan::create([
                'user_id' => Auth::id(),
                'reservasi_id' => $tiket->id,
                'kategori' => $request->jenis,
                'nama_pemesan' => Auth::user()->name,
                'email' => Auth::user()->email,
                'telepon' => Auth::user()->mobile_number,
                'total' => $hargaAkhir,
                'status' => 'Pending',
            ]);

            // 🔹 Konfigurasi Midtrans
            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            // 🔹 Buat Order ID unik
            $orderId = 'ORDER-' . $pemesanan->id . '-' . strtoupper(Str::random(5));

            // 🔹 Data transaksi ke Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $hargaAkhir,
                ],
                'item_details' => [[
                    'id' => $tiket->id,
                    'price' => (int) $hargaAkhir,
                    'quantity' => 1,
                    'name' => $tiket->nama_paket ?? 'Tiket Waterpark',
                ]],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->mobile_number,
                ],
            ];

            // 🔹 Dapatkan Snap Token dari Midtrans
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // 🔹 Update Order ID di database
            $pemesanan->update(['midtrans_order_id' => $orderId]);

            return response()->json([
                'snap_token' => $snapToken,
                'client_key' => config('services.midtrans.client_key'),
                'harga' => $hargaAkhir,
                'message' => 'Transaksi siap diproses',
            ]);

        } catch (\Exception $e) {
            Log::error("Midtrans Error: " . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Gagal membuat token Midtrans: ' . $e->getMessage(),
            ], 500);
        }
    }
}
