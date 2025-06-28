@extends('layouts.app')

@section('title', 'Pembayaran DP')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Pembayaran Uang Muka (DP)</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <p>Terima kasih, <strong>{{ $order->nama }}</strong>, pesanan Anda dengan ID <strong>{{ $order->rent_id }}</strong> telah berhasil dikirim.</p>

            <h5>Detail Pesanan:</h5>
            <ul>
                <li><strong>Mobil:</strong> {{ $order->car->nama_mobil }}</li>
                <li><strong>Tanggal Sewa:</strong> {{ \Carbon\Carbon::parse($order->tanggal_pesan)->format('d M Y') }}</li>
                <li><strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($order->tanggal_kembali)->format('d M Y') }}</li>
                <li><strong>Lama Sewa:</strong> {{ $days }} hari</li>
                <li><strong>Harga Sewa per Hari:</strong> Rp{{ number_format($order->car->harga_sewa_per_hari, 0, ',', '.') }}</li>
                <li><strong>Total Sewa Mobil:</strong> Rp{{ number_format($harga_sewa, 0, ',', '.') }}</li>
                <li><strong>Biaya Sopir:</strong>
                    @if($order->with_driver)
                        Rp{{ number_format($biaya_supir, 0, ',', '.') }} (Rp100.000 x {{ $days }} hari)
                    @else
                        Tidak menggunakan sopir
                    @endif
                </li>
                <li><strong>Total Biaya:</strong> Rp{{ number_format($total, 0, ',', '.') }}</li>
            </ul>

            <hr>

            <h5>Instruksi Pembayaran DP:</h5>
            <ul>
                <li><strong>Bank:</strong> BCA</li>
                <li><strong>No Rekening:</strong> 5789101112</li>
                <li><strong>Atas Nama:</strong> Juragan Rental</li>
                <li><strong>Jumlah DP:</strong> Rp300.000 (atau minimal 30% dari total biaya rental)</li>
            </ul>

            <p>Setelah melakukan transfer, kirim bukti pembayaran ke admin kami melalui WhatsApp:</p>

            @php
                $message = "Halo Admin, saya telah melakukan DP untuk pesanan dengan ID *{$order->rent_id}* atas nama *{$order->nama}*. Berikut bukti pembayarannya:";
                $waLink = "https://wa.me/6281234567890?text=" . urlencode($message);
            @endphp

            <a href="{{ $waLink }}" class="btn btn-success mb-3" target="_blank">
                <i class="fa fa-whatsapp"></i> Kirim Bukti via WhatsApp
            </a>
            <br>
            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
