<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Order;

class PublicOrderController extends Controller
{
    public function create()
    {
        $cars = Car::all();
        return view('orders.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'tanggal_pesan' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pesan',
            'car_id' => 'required|exists:cars,id',
            'with_driver' => 'required|boolean',
            'ktp_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('ktp_image')->store('ktp', 'public');

        Order::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_pesan' => $request->tanggal_pesan,
            'tanggal_kembali' => $request->tanggal_kembali,
            'car_id' => $request->car_id,
            'with_driver' => $request->with_driver,
            'ktp_path' => $path,
        ]);

        return redirect('/pesan')->with('success', 'Pesanan berhasil dikirim!');
    }
}
