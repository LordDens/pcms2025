<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Http\Request;

class RentController extends Controller
{
    // Tampilkan semua data rental
    public function index()
    {
        $rents = Rent::with(['customer', 'car'])->get();
        return view('rents.index', compact('rents'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        $customers = Customer::all();
        $cars = Car::all();
        return view('rents.create', compact('customers', 'cars'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'       => 'required|exists:customers,id',
            'car_id'            => 'required|exists:cars,id',
            'kode_transaksi'    => 'required|string|max:50|unique:rents,kode_transaksi',
            'tanggal_sewa'      => 'required|date',
            'tanggal_kembali'   => 'required|date|after_or_equal:tanggal_sewa',
            'lama_sewa'         => 'required|integer|min:1',
            'sopir'             => 'required|string|in:dengan sopir,tanpa sopir',
            'biaya'             => 'required|numeric|min:0',
            'dp'                => 'required|numeric|min:0',
            'belum_terbayar'    => 'required|numeric|min:0',
            'with_driver'       => 'required|boolean',
        ]);

        Rent::create($request->all());

        return redirect()->route('rents.index')->with('success', 'Data rental berhasil ditambahkan.');
    }

    // Tampilkan detail sewa
    public function show(Rent $rent)
    {
        return view('rents.show', compact('rent'));
    }

    // Tampilkan form edit
    public function edit(Rent $rent)
    {
        $customers = Customer::all();
        $cars = Car::all();
        return view('rents.edit', compact('rent', 'customers', 'cars'));
    }

    // Simpan perubahan data
    public function update(Request $request, Rent $rent)
    {
        $request->validate([
            'customer_id'       => 'required|exists:customers,id',
            'car_id'            => 'required|exists:cars,id',
            'kode_transaksi'    => 'required|string|max:50|unique:rents,kode_transaksi,' . $rent->id,
            'tanggal_sewa'      => 'required|date',
            'tanggal_kembali'   => 'required|date|after_or_equal:tanggal_sewa',
            'lama_sewa'         => 'required|integer|min:1',
            'sopir'             => 'required|string|in:dengan sopir,tanpa sopir',
            'biaya'             => 'required|numeric|min:0',
            'dp'                => 'required|numeric|min:0',
            'belum_terbayar'    => 'required|numeric|min:0',
            'with_driver'       => 'required|boolean',
        ]);

        $rent->update($request->all());

        return redirect()->route('rents.index')->with('success', 'Data rental berhasil diperbarui.');
    }

    // Hapus data sewa
    public function destroy(Rent $rent)
    {
        $rent->delete();
        return redirect()->route('rents.index')->with('success', 'Data rental berhasil dihapus.');
    }
}
