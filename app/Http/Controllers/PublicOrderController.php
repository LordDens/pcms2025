<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Car;
use App\Models\Rent;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PublicOrderController extends Controller
{
    /**
     * ✅ 1. Tampilkan form pemesanan
     */
    public function create()
    {
        try {
            $cars = Car::all();
            return view('orders.create', compact('cars'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Gagal memuat halaman pemesanan. (' . $e->getMessage() . ')');
        }
    }

    /**
     * ✅ 2. Proses simpan pesanan
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nama'            => 'required|string|max:60',
                'nik'             => 'required|string|max:16',
                'tanggal_pesan'   => 'required|date',
                'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pesan',
                'car_id'          => 'required|exists:cars,id',
                'with_driver'     => 'required|boolean',
                'ktp_image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Cek NIK
            $existing = Order::where('nik', $validated['nik'])->first();
            if ($existing && $existing->nama !== $validated['nama']) {
                return back()->withInput()->withErrors([
                    'nik' => 'NIK ini sudah digunakan oleh nama yang berbeda.',
                ]);
            }

            // Simpan KTP
            $path = $request->file('ktp_image')->store('ktp', 'public');

            // Buat kode unik
            $rentId = 'RENT-' . strtoupper(uniqid());

            // Hitung durasi & biaya
            $start = Carbon::parse($validated['tanggal_pesan']);
            $end   = Carbon::parse($validated['tanggal_kembali']);
            $days  = max($start->diffInDays($end), 1);

            $car = Car::findOrFail($validated['car_id']);
            $harga_sewa = $car->harga_sewa_per_hari * $days;
            $biaya_supir = $validated['with_driver'] ? (100000 * $days) : 0;
            $total = $harga_sewa + $biaya_supir;

            // Simpan ke orders
            Order::create([
                'rent_id'         => $rentId,
                'nama'            => $validated['nama'],
                'nik'             => $validated['nik'],
                'tanggal_pesan'   => $validated['tanggal_pesan'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'car_id'          => $validated['car_id'],
                'with_driver'     => $validated['with_driver'],
                'ktp_path'        => $path,
            ]);

            // Simpan ke rents
            Rent::create([
                'customer_id'      => null, // bisa diganti Auth::id() jika user login
                'car_id'           => $validated['car_id'],
                'tanggal_sewa'     => $validated['tanggal_pesan'],
                'tanggal_kembali'  => $validated['tanggal_kembali'],
                'lama_sewa'        => $days,
                'harga_sewa'       => $harga_sewa,
                'with_driver'      => $validated['with_driver'],
                'driver'           => $validated['with_driver'] ? 'Dengan Supir' : 'Tanpa Supir',
                'dp'               => 0,
                'total_pendapatan' => $total,
                'belum_terbayar'   => $total,
                'kode_transaksi'   => $rentId,
            ]);

            Log::info('Pesanan berhasil disimpan', [
                'rent_id' => $rentId,
                'nama'    => $validated['nama'],
            ]);

            return redirect()->route('pesanan.payment', $rentId)
                ->with('success', 'Pesanan berhasil dikirim! Silakan lanjut ke pembayaran DP.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pesanan', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan pesanan. (' . $e->getMessage() . ')');
        }
    }

    /**
     * ✅ 3. Lihat detail pesanan
     */
    public function show($rent_id)
    {
        $order = Order::where('rent_id', $rent_id)->firstOrFail();
        return view('orders.show', compact('order'));
    }

    /**
     * ✅ 4. Tampilkan form pembayaran DP
     */
    public function payment($rent_id)
    {
        $order = Order::where('rent_id', $rent_id)->firstOrFail();
        $car   = $order->car;

        $start = Carbon::parse($order->tanggal_pesan);
        $end   = Carbon::parse($order->tanggal_kembali);
        $days  = max($start->diffInDays($end), 1);

        $harga_sewa  = $car->harga_sewa_per_hari * $days;
        $biaya_supir = $order->with_driver ? (100000 * $days) : 0;
        $total       = $harga_sewa + $biaya_supir;

        return view('orders.payment', compact('order', 'harga_sewa', 'biaya_supir', 'total', 'days'));
    }

    public function userRentals()
    {
    $rents = Rent::with('car')
                ->where('customer_id', Auth::id())
                ->latest()
                ->get();

    return view('rents.my', compact('rents'));
    }
}
