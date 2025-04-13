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
            'kode_transaksi' => 'required|unique:rents,kode_transaksi',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'lama_sewa' => 'required|integer',
            'sopir' => 'required|string',
            'biaya' => 'required|integer',
            'dp' => 'required|integer',
            'belum_terbayar' => 'required|integer',
        ]);

        Rent::create($request->all());
        return redirect()->route('rents.index')->with('success', 'Data rental berhasil ditambahkan.');
    }

    public function show(Rent $rent)
    {
        return view('rents.show', compact('rent'));
    }

    public function edit(Rent $rent)
    {
        $customers = Customer::all();
        $cars = Car::all();
        return view('rents.edit', compact('rent', 'customers', 'cars'));
    }

    public function update(Request $request, Rent $rent)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'kode_transaksi' => 'required|unique:rents,kode_transaksi,' . $rent->id,
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'lama_sewa' => 'required|integer',
            'sopir' => 'required|string',
            'biaya' => 'required|integer',
            'dp' => 'required|integer',
            'belum_terbayar' => 'required|integer',
        ]);

        $rent->update($request->all());
        return redirect()->route('rents.index')->with('success', 'Data rental berhasil diupdate.');
    }

    public function destroy(Rent $rent)
    {
        $rent->delete();
        return redirect()->route('rents.index')->with('success', 'Data rental berhasil dihapus.');
    }
}
