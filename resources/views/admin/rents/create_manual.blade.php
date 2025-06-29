@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Data Sewa (Manual)</h2>

    {{-- Tampilkan error --}}
    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('rents.storeManual') }}">
        @csrf

        {{-- Nama Pelanggan --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- NIK --}}
        <div class="mb-4">
            <label for="nik" class="block font-semibold mb-1">NIK (16 digit)</label>
            <input type="text" name="nik" id="nik" maxlength="16" value="{{ old('nik') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('nik')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Pilih Mobil --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Pilih Mobil</label>
            <select name="car_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                        {{ $car->nama_mobil }} - {{ $car->jenis }}
                    </option>
                @endforeach
            </select>
            @error('car_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal Sewa --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tanggal Sewa</label>
            <input type="date" name="tanggal_sewa" value="{{ old('tanggal_sewa') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- Tanggal Kembali --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- Dengan Sopir (opsional) --}}
        <div class="mb-4">
            {{-- Kirim nilai 0 jika checkbox tidak dicentang --}}
            <input type="hidden" name="with_driver" value="0">
            <label class="inline-flex items-center">
                <input type="checkbox" name="with_driver" value="1" class="form-checkbox"
                    {{ old('with_driver') ? 'checked' : '' }}>
                <span class="ml-2">Dengan Sopir</span>
            </label>
        </div>

        {{-- Harga Total --}}
        <div class="mb-6">
            <label class="block font-semibold mb-1">Harga Total (Rp)</label>
            <input type="number" name="harga_total" value="{{ old('harga_total') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="flex items-center">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                Simpan
            </button>
            <a href="{{ route('rents.index') }}" class="ml-4 text-gray-600 hover:underline">Kembali</a>
        </div>
    </form>
</div>
@endsection
