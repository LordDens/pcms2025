@extends('layouts.app')

@section('title', 'Laporan Bulanan')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">📊 Laporan Bulanan</h1>

    {{-- Filter Bulan --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.laporan.index') }}">
            <label for="bulan" class="font-semibold mr-2">🗓️ Pilih Bulan:</label>
            <select name="bulan" id="bulan" onchange="this.form.submit()" class="border rounded px-2 py-1">
                @foreach ($months as $key => $label)
                    <option value="{{ $key }}" {{ $key == $selectedMonth ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Statistik Box --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-green-100 p-4 rounded shadow">
            <h5 class="font-semibold text-green-700">✅ Terkonfirmasi</h5>
            <p class="text-2xl font-bold">{{ $jumlahPesanan }}</p>
        </div>

        <div class="bg-yellow-100 p-4 rounded shadow">
            <h5 class="font-semibold text-yellow-700">💰 Total Pendapatan</h5>
            <p class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>

        <div class="bg-blue-500 text-white p-4 rounded shadow">
            <h5 class="font-semibold">👤 Total Pelanggan Unik</h5>
            <p class="text-2xl font-bold">{{ $totalPelangganUnik ?? 0 }}</p>
        </div>
    </div>

    {{-- Statistik Mobil --}}
    <div class="bg-white border rounded shadow p-4">
        <h5 class="font-semibold text-lg mb-2">🚗 Statistik Mobil Terbanyak Dipesan</h5>
        <ul class="list-disc list-inside">
            @forelse ($mobilTerbanyak as $mobil)
                <li>{{ $mobil->nama_mobil }} - {{ $mobil->total }}x</li>
            @empty
                <li>Tidak ada data</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
