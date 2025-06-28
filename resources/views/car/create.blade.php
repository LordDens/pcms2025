@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Tambah Mobil Baru</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('car.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nama_mobil" class="form-label">Nama Mobil</label>
            <input type="text" name="nama_mobil" class="form-control" value="{{ old('nama_mobil') }}" required>
            @error('nama_mobil')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jenis_mobil" class="form-label">Jenis Mobil</label>
            <input type="text" name="jenis_mobil" class="form-control" value="{{ old('jenis_mobil') }}" required>
            @error('jenis_mobil')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="transmisi" class="form-label">Transmisi</label>
            <select name="transmisi" class="form-control" required>
                <option value="">-- Pilih Transmisi --</option>
                <option value="Manual" {{ old('transmisi') == 'Manual' ? 'selected' : '' }}>Manual</option>
                <option value="Matic" {{ old('transmisi') == 'Matic' ? 'selected' : '' }}>Matic</option>
            </select>
            @error('transmisi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ready" class="form-label">Status</label>
            <select name="ready" class="form-control" required>
                <option value="1" {{ old('ready') == '1' ? 'selected' : '' }}>Ready</option>
                <option value="0" {{ old('ready') == '0' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
            @error('ready')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga_sewa_per_hari" class="form-label">Harga Sewa per Hari</label>
            <input type="number" name="harga_sewa_per_hari" class="form-control" value="{{ old('harga_sewa_per_hari') }}" required>
            @error('harga_sewa_per_hari')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="foto">Foto Mobil</label>
            <input type="file" class="form-control" name="foto" accept="image/*">
        </div>


        <button type="submit" class="btn btn-success">Simpan Mobil</button>
    </form>
</div>
@endsection
