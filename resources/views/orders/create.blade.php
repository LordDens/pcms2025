@extends('layouts.app')

@section('title', 'Form Pemesanan Kendaraan')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Form Pemesanan Kendaraan</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                <ul class="list-disc pl-5 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- NIK -->
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-200">NIK</label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal Sewa -->
                <div>
                    <label for="tanggal_pesan" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Sewa</label>
                    <input type="date" name="tanggal_pesan" id="tanggal_pesan" value="{{ old('tanggal_pesan') }}"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-white rounded-md shadow-sm sm:text-sm">
                    @error('tanggal_pesan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal Kembali -->
                <div>
                    <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-white rounded-md shadow-sm sm:text-sm">
                    @error('tanggal_kembali') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Pilih Mobil -->
                <div class="md:col-span-2">
                    <label for="car_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pilih Mobil</label>
                    <select name="car_id" id="car_id"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-white rounded-md shadow-sm sm:text-sm">
                        <option value="">-- Pilih Mobil --</option>
                        @foreach($cars as $car)
                            <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                {{ $car->nama_mobil }} - Rp {{ number_format($car->harga_sewa_per_hari, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('car_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Dengan Sopir -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Dengan Sopir?</label>
                    <div class="flex items-center space-x-6 mt-1">
                        <label class="inline-flex items-center">
                            <input type="radio" name="with_driver" value="1" {{ old('with_driver') == '1' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-200">Ya</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="with_driver" value="0" {{ old('with_driver') == '0' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-200">Tidak</span>
                        </label>
                    </div>
                    @error('with_driver') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Upload KTP -->
                <div>
                    <label for="ktp_image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Upload Foto KTP</label>
                    <input type="file" name="ktp_image" id="ktp_image"
                        class="mt-1 block w-full text-sm text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('ktp_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow">
                    Kirim Pemesanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
