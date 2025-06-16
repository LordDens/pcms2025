@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Pesanan Baru</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pesan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pilih Mobil</label>
            <select name="car_id" class="form-control" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->nama_mobil }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Dengan Sopir?</label>
            <select name="with_driver" class="form-control" required>
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Upload KTP</label>
            <input type="file" name="ktp_image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
    </form>
</div>
@endsection
