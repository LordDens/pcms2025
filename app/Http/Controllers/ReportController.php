<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * ✅ Tampilkan laporan bulanan.
     */
    public function index(Request $request)
    {
    $bulan = $request->input('bulan', now()->format('m'));
    $tahun = now()->format('Y');

    $startOfMonth = Carbon::create($tahun, $bulan)->startOfMonth();
    $endOfMonth = Carbon::create($tahun, $bulan)->endOfMonth();

    $rents = Rent::whereBetween('tanggal_sewa', [$startOfMonth, $endOfMonth])
                ->where('is_confirmed', true)
                ->get();

    $jumlahPesanan = $rents->count();
    $totalPendapatan = $rents->sum('total_pendapatan');
    $totalPelangganUnik = $rents->unique('customer_id')->count();

    $mobilTerbanyak = Rent::select('cars.nama_mobil', DB::raw('COUNT(*) as total'))
        ->join('cars', 'rents.car_id', '=', 'cars.id')
        ->whereBetween('tanggal_sewa', [$startOfMonth, $endOfMonth])
        ->where('is_confirmed', true)
        ->groupBy('cars.nama_mobil')
        ->orderByDesc('total')
        ->get();

    $months = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
        '04' => 'April',   '05' => 'Mei',      '06' => 'Juni',
        '07' => 'Juli',    '08' => 'Agustus',  '09' => 'September',
        '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
    ];

    return view('admin.laporan.index', compact(
        'jumlahPesanan',
        'totalPendapatan',
        'totalPelangganUnik',
        'mobilTerbanyak',
        'months',
        'bulan' // sebagai $selectedMonth di blade
    ))->with('selectedMonth', $bulan);
    }
}
