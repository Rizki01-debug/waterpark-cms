<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    /**
     * 🔹 Halaman utama laporan
     */
    public function index(Request $request)
    {
        // Ambil filter dari request
        $start = $request->get('start_date', Carbon::now()->startOfMonth());
        $end = $request->get('end_date', Carbon::now()->endOfMonth());
        $kategori = $request->get('kategori'); // tiket / penginapan
        $status = $request->get('status');     // Konfirmasi / Berhasil / Batal

        // Query dasar
        $query = Pemesanan::whereBetween('created_at', [$start, $end]);

        if ($kategori) $query->where('jenis', $kategori);
        if ($status) $query->where('status', $status);

        // Statistik dasar
        $totalProfit = (clone $query)->sum('total');
        $totalTiket = (clone $query)->where('jenis', 'tiket')->count();
        $totalPenginapan = (clone $query)->where('jenis', 'penginapan')->count();
        $totalPengunjung = (clone $query)->distinct('nama_pemesan')->count('nama_pemesan');

        // Grafik profit per hari
        $chartData = (clone $query)
            ->select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(total) as total_profit')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        // Data transaksi detail
        $transaksi = (clone $query)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend.laporan.index', compact(
            'start', 'end', 'kategori', 'status',
            'totalProfit', 'totalTiket', 'totalPenginapan',
            'totalPengunjung', 'chartData', 'transaksi'
        ));
    }

    /**
     * 🔹 Export Excel
     */
    public function exportExcel(Request $request)
    {
        $start = $request->get('start_date', now()->startOfMonth());
        $end = $request->get('end_date', now()->endOfMonth());
        $kategori = $request->get('kategori');
        $status = $request->get('status');

        $filename = 'laporan_waterpark_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new LaporanExport($start, $end, $kategori, $status), $filename);
    }

    /**
     * 🔹 Export PDF
     */
    public function exportPDF(Request $request)
    {
        $start = $request->get('start_date', now()->startOfMonth());
        $end = $request->get('end_date', now()->endOfMonth());
        $kategori = $request->get('kategori');
        $status = $request->get('status');

        // Query laporan
        $query = Pemesanan::whereBetween('created_at', [$start, $end]);
        if ($kategori) $query->where('jenis', $kategori);
        if ($status) $query->where('status', $status);

        $transaksi = $query->orderBy('created_at', 'desc')->get();

        // Generate PDF
        $pdf = Pdf::loadView('backend.laporan.pdf', [
            'transaksi' => $transaksi,
            'start' => $start,
            'end' => $end,
            'kategori' => $kategori,
            'status' => $status
        ])->setPaper('a4', 'portrait');

        $filename = 'laporan_waterpark_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        return $pdf->download($filename);
    }
}
