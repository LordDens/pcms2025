@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pesanan</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title"><strong>ID Pemesanan:</strong> {{ $order->rent_id }}</h5>
            <p><strong>Nama:</strong> {{ $order->nama }}</p>
            <p><strong>NIK:</strong> {{ $order->nik }}</p>
            <p><strong>Tanggal Pesan:</strong> {{ $order->tanggal_pesan }}</p>
            <p><strong>Tanggal Kembali:</strong> {{ $order->tanggal_kembali }}</p>
            <p><strong>Mobil:</strong> {{ $order->car->nama_mobil ?? '-' }}</p>
            <p><strong>Dengan Sopir:</strong> {{ $order->with_driver ? 'Ya' : 'Tidak' }}</p>

            @if ($order->ktp_path)
                <div class="mt-3">
                    <p><strong>Foto KTP:</strong></p>
                    <img src="{{ asset('storage/' . $order->ktp_path) }}" alt="Foto KTP" class="img-thumbnail" width="250">
                </div>
            @endif
        </div>
    </div>

    <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
</div>
@endsection
