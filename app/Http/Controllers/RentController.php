<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index()
    {
        $rents = Rent::with(['customer', 'car'])->get();
        return view('rents.index', compact('rents'));
    }

    public function create()
    {
        $customers = Customer::all();
        $cars = Car::all();
        return view('rents.create', compact('customers', 'cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'with_driver' => 'nullable|boolean',
        ]);

        // Hitung lama sewa & harga
        $car = Car::findOrFail($request->car_id);
        $lama = (strtotime($request->tanggal_kembali) - strtotime($request->tanggal_sewa)) / 86400;
        $harga_total = $car->harga_sewa_per_hari * $lama;

        if ($request->with_driver) {
            $harga_total += 75000 * $lama; //
        }

        Rent::create([
            'customer_id' => $request->customer_id,
            'car_id' => $request->car_id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'with_driver' => $request->with_driver ?? false,
            'harga_sewa' => $harga_total,
        ]);
    }
        public function edit($id)
        {
            $rent = Rent::findOrFail($id);
            $customers = Customer::all();
            $cars = Car::all();
            return view('rents.edit', compact('rent', 'customers', 'cars'));
        }
        public function update(Request $request, $id)
    {
        $rent = Rent::findOrFail($id);

        $request->validate([
            'customer_id' => 'required',
            'car_id' => 'required',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
        ]);

        $lama = (strtotime($request->tanggal_kembali) - strtotime($request->tanggal_sewa)) / 86400;
        $car = Car::findOrFail($request->car_id);
        $harga_total = $car->harga_sewa_per_hari * $lama;
        if ($request->with_driver) {
            $harga_total += 75000 * $lama;
        }

        $rent->update([
            'customer_id' => $request->customer_id,
            'car_id' => $request->car_id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'with_driver' => $request->has('with_driver'),
            'harga_sewa' => $harga_total,
            'driver' => $request->with_driver ? 'YORDAN' : 'TANPA SOPIR',
            'total_pendapatan' => $harga_total,
            'belum_terbayar' => $harga_total,
        ]);

        return redirect()->route('rents.index')->with('success', 'Data sewa berhasil ditambahkan!');
    }
}
