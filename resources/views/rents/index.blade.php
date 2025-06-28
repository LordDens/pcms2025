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
                <th>Status</th>
                <th>Aksi</th>
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
                    @if ($rent->is_confirmed)
                        <span class="badge bg-success text-white">Terkonfirmasi</span>
                    @else
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    @endif
                </td>
                <td>
                    @if (!$rent->is_confirmed)
                        <form action="{{ route('admin.rents.confirm', $rent->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pesanan ini?')">✔ Konfirmasi</button>
                        </form>

                        <a href="{{ route('rents.edit', $rent->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('rents.destroy', $rent->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    @else
                        <span class="text-muted">✔ Terkonfirmasi</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
