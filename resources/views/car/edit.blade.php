@extends('layouts.app')

@section('title', 'Edit Mobil')

@section('content')
<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Data Mobil</h4>
        </div>
        <div class="card-body">

            {{-- Tampilkan Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan!</strong> Silakan periksa kembali inputan Anda.
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('car.update', $car->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Mobil --}}
                <div class="mb-3">
                    <label for="nama_mobil" class="form-label">Nama Mobil</label>
                    <input type="text" name="nama_mobil" class="form-control" value="{{ old('nama_mobil', $car->nama_mobil) }}" required>
                </div>

                {{-- Harga Sewa --}}
                <div class="mb-3">
                    <label for="harga_sewa_per_hari" class="form-label">Harga Sewa per Hari (Rp)</label>
                    <input type="number" name="harga_sewa_per_hari" class="form-control" value="{{ old('harga_sewa_per_hari', $car->harga_sewa_per_hari) }}" required>
                </div>

                {{-- Jenis Mobil --}}
                <div class="mb-3">
                    <label for="jenis_mobil" class="form-label">Jenis Mobil</label>
                    <input type="text" name="jenis_mobil" class="form-control" value="{{ old('jenis_mobil', $car->jenis_mobil) }}" required>
                </div>

                {{-- Transmisi --}}
                <div class="mb-3">
                    <label for="transmisi" class="form-label">Transmisi</label>
                    <select name="transmisi" class="form-select" required>
                        <option value="Manual" {{ $car->transmisi == 'Manual' ? 'selected' : '' }}>Manual</option>
                        <option value="Matic" {{ $car->transmisi == 'Matic' ? 'selected' : '' }}>Matic</option>
                    </select>
                </div>

                {{-- Status Ketersediaan --}}
                <div class="mb-3">
                    <label for="ready" class="form-label">Status Ketersediaan</label>
                    <select name="ready" class="form-select" required>
                        <option value="1" {{ $car->ready ? 'selected' : '' }}>Tersedia</option>
                        <option value="0" {{ !$car->ready ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori Mobil</label>
                    <select name="kategori_id" class="form-select" required>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $car->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Foto Mobil --}}
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Mobil</label>
                    @if($car->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $car->foto) }}" alt="Foto Mobil" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" name="foto" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Mobil</button>
                    <a href="{{ route('car.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
