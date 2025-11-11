<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Fasilitas;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // =====================================================
        // 🔹 Statistik Umum
        // =====================================================

        // Total pengunjung unik
        $totalPengunjung = Pemesanan::distinct('nama_pemesan')->count('nama_pemesan');

        // Jumlah reservasi hari ini
        $reservasiHariIni = Pemesanan::whereDate('created_at', Carbon::today())->count();

        // Pendapatan bulan ini (hanya status "Berhasil")
        $pendapatanBulanIni = Pemesanan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'Berhasil')
            ->sum('total');

        $pendapatanBulanIni = 'Rp ' . number_format($pendapatanBulanIni, 0, ',', '.');

        // Jumlah fasilitas aktif
        $fasilitasAktif = Fasilitas::where('status', true)->count();


        // =====================================================
        // 📊 Grafik Pengunjung Bulanan (Jan–Des)
        // =====================================================
        $chartData = Pemesanan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Label bulan tetap (1–12)
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // Isi dengan nilai 0 untuk bulan tanpa transaksi
        $chartValues = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartValues[] = $chartData[$i] ?? 0;
        }


        // =====================================================
        // 🥧 Grafik Status Transaksi (Pie Chart)
        // =====================================================
        $statusCounts = Pemesanan::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $berhasil = $statusCounts['Berhasil'] ?? 0;
        $pending  = $statusCounts['Pending'] ?? 0;
        $batal    = $statusCounts['Batal'] ?? 0;


        // =====================================================
        // 🔹 Kirim Data ke View
        // =====================================================
        return view('backend.dashboard', compact(
            'fasilitasAktif',
            'totalPengunjung',
            'reservasiHariIni',
            'pendapatanBulanIni',
            'labels',
            'chartValues',
            'berhasil',
            'pending',
            'batal'
        ));
    }
}
