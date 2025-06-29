<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\User;

class RentController extends Controller
{
    // Tampilkan semua data rental
    public function index()
    {
        $rents = Rent::with(['customer', 'car'])->latest()->get();
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

        public function storeManual(Request $request)
        {
            $validated = $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'nik' => [
                    'required',
                    'digits:16',
                    function ($attribute, $value, $fail) use ($request) {
                        $existing = Rent::where('nik', $value)
                            ->where('nama_pelanggan', '!=', $request->nama_pelanggan)
                            ->first();
                        if ($existing) {
                            $fail('NIK sudah digunakan untuk nama pelanggan yang berbeda.');
                        }
                    }
                ],
                'car_id' => 'required|exists:cars,id',
                'tanggal_sewa' => 'required|date',
                'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
                'with_driver' => 'nullable|boolean',
                'harga_total' => 'required|numeric',
            ]);

            Rent::create([
                'customer_id' => null,
                'car_id' => $validated['car_id'],
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'nik' => $validated['nik'],
                'tanggal_sewa' => $validated['tanggal_sewa'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'with_driver' => $validated['with_driver'] ?? false,
                'total_pendapatan' => $validated['harga_total'],
                'harga_sewa' => $validated['harga_total'],
                'is_confirmed' => true,
            ]);

            return redirect()->route('rents.index')->with('success', 'Sewa berhasil ditambahkan secara manual.');
        }

        public function createManual()
            {
                $cars = Car::all();
                return view('admin.rents.create_manual', compact('cars'));
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

    // Tampilkan daftar sewa khusus admin (dengan status konfirmasi)
    public function adminIndex()
    {
        $rents = Rent::with(['customer', 'car'])->latest()->get();
        return view('admin.rents.index', compact('rents'));
    }

    // Update status konfirmasi sewa
    public function updateStatus(Request $request, Rent $rent)
    {
        $rent->is_confirmed = true;
        $rent->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function myRentals()
    {
    // Hanya user yang login
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $userId = Auth::id();
    
    // Ambil semua pesanan yang dibuat oleh user login
    $rents = Rent::where('user_id', $userId)->with('car')->latest()->get();

    return view('rents.my', compact('rents'));
    }

}
