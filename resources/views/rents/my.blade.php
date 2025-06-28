@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rental Saya</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($rents->isEmpty())
        <p>Belum ada pesanan yang tercatat atas nama Anda.</p>
    @else
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Mobil</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Supir</th>
                    <th>Harga Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rents as $rent)
                <tr>
                    <td>{{ $rent->car->nama_mobil ?? 'N/A' }}</td>
                    <td>{{ $rent->tanggal_sewa }}</td>
                    <td>{{ $rent->tanggal_kembali }}</td>
                    <td>{{ $rent->with_driver ? 'Ya' : 'Tidak' }}</td>
                    <td>Rp {{ number_format($rent->total_pendapatan, 0, ',', '.') }}</td>
                    <td>
                        @if ($rent->is_confirmed)
                            <span class="badge bg-success">Dikonfirmasi</span>
                        @else
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
