@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Pesanan Baru</h1>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Notifikasi error umum --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Notifikasi error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pesan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" class="form-control" value="{{ old('tanggal_pesan') }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali') }}" required>
        </div>

        <div class="mb-3">
            <label>Pilih Mobil</label>
            <select name="car_id" class="form-control" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                        {{ $car->nama_mobil }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Dengan Sopir?</label>
            <select name="with_driver" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="1" {{ old('with_driver') == '1' ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ old('with_driver') == '0' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Upload Foto KTP</label>
            <input type="file" name="ktp_image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
    </form>
</div>
@endsection
