@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Sewa Mobil</h1>

    <a href="{{ route('rents.create') }}" class="btn btn-success mb-3">+ Tambah Sewa</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Mobil</th>
                <th>Jenis Mobil</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Sopir</th>
                <th>Harga Sewa</th>
                <th>Aksi</th> {{-- Tambahkan kolom aksi --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($rents as $rent)
            <tr>
                <td>{{ $rent->customer->nama ?? 'N/A' }}</td>
                <td>{{ $rent->car->nama_mobil ?? 'N/A' }}</td>
                <td>{{ $rent->car->jenis_mobil ?? 'N/A' }}</td>
                <td>{{ $rent->tanggal_sewa }}</td>
                <td>{{ $rent->tanggal_kembali }}</td>
                <td>{{ $rent->with_driver ? 'Ya' : 'Tidak' }}</td>
                <td>Rp {{ number_format($rent->harga_sewa ?? 0, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('rents.edit', $rent->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('rents.destroy', $rent->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
