<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $start;
    protected $end;
    protected $kategori;
    protected $status;

    public function __construct($start, $end, $kategori = null, $status = null)
    {
        $this->start = $start;
        $this->end = $end;
        $this->kategori = $kategori;
        $this->status = $status;
    }

    public function collection()
    {
        $query = Pemesanan::whereBetween('created_at', [$this->start, $this->end]);

        if ($this->kategori) {
            $query->where('jenis', $this->kategori);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pemesan',
            'Email',
            'Telepon',
            'Jenis',
            'Total',
            'Status',
            'Tanggal Pemesanan',
        ];
    }

    public function map($pemesanan): array
    {
        static $no = 1;

        return [
            $no++,
            $pemesanan->nama_pemesan,
            $pemesanan->email,
            $pemesanan->telepon,
            ucfirst($pemesanan->jenis ?? '-'),
            'Rp ' . number_format($pemesanan->total ?? 0, 0, ',', '.'),
            $pemesanan->status,
            $pemesanan->created_at->format('d-m-Y H:i'),
        ];
    }
}
