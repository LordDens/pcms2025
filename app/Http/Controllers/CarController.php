<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        return view('car.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'jenis_mobil' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'transmisi' => 'required|in:Manual,Matic',
            'ready' => 'required|boolean',
            'harga_sewa_per_hari' => 'required|numeric',
        ]);

        Car::create($validated);

        return redirect()->route('car.create')->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function index()
    {
        $cars = Car::where('ready', 1)->with('kategori')->get();
        return view('car.index', compact('cars'));
    }

    public function edit(Car $car)
    {
        $kategoris = Kategori::all();
        return view('car.edit', compact('car', 'kategoris')); // pastikan folder = 'cars'
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'harga_sewa_per_hari' => 'required|numeric',
            'jenis_mobil' => 'required|string',
            'transmisi' => 'required|in:Manual,Matic',
            'ready' => 'required|boolean',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika upload foto baru, hapus lama dan simpan yang baru
        if ($request->hasFile('foto')) {
            if ($car->foto && Storage::disk('public')->exists($car->foto)) {
                Storage::disk('public')->delete($car->foto);
            }

            $validated['foto'] = $request->file('foto')->store('cars', 'public');
        }

        $car->update($validated);

        return redirect()->route('car.index')->with('success', 'Data mobil berhasil diperbarui.');
    }
}
