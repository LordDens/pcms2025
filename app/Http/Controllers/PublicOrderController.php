<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Car;

class PublicOrderController extends Controller
{
    // Tampilkan form pemesanan (dengan error handling try-catch)
    public function create()
    {
        try {
            $cars = Car::all();
            return view('orders.create', compact('cars'));

        } catch (\Exception $e) {
            return redirect('/')
                ->with('error', 'Gagal memuat halaman pemesanan. Silakan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    // Proses simpan pesanan ke database
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'nik' => 'required|string|max:20',
                'tanggal_pesan' => 'required|date',
                'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pesan',
                'car_id' => 'required|exists:cars,id',
                'with_driver' => 'required|boolean',
                'ktp_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Upload file ke storage/public/ktp
            $path = $request->file('ktp_image')->store('ktp', 'public');

            // Auto Generated Rent ID
            $rentId = 'RENT-' . strtoupper(uniqid());

            // Simpan ke database
            Order::create([
                'rent_id' => $rentId,
                'nama' => $validated['nama'],
                'nik' => $validated['nik'],
                'tanggal_pesan' => $validated['tanggal_pesan'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'car_id' => $validated['car_id'],
                'with_driver' => $validated['with_driver'],
                'ktp_path' => $path,
            ]);

            return redirect()->route('pesanan.show', $rentId)
            ->with('success', 'Pesanan berhasil dikirim! ID Anda: ' . $rentId);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan pesanan. (' . $e->getMessage() . ')');
        }
    }
    public function show($rent_id)
    {
        $order = \App\Models\Order::where('rent_id', $rent_id)->firstOrFail();
        return view('orders.show', compact('order'));
    }

}
