@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="section">
        <div class="container text-center">
            <h1>Selamat Datang di Juragan Rental</h1>
            <p>Sewa mobil dengan mudah, cepat, dan terpercaya.</p>

            <a href="{{ route('rents.index') }}" class="btn btn-primary mt-3">Lihat Data Sewa</a>
            <a href="{{ url('/pesan') }}" class="btn btn-primary">  Buat Pesanan Baru </a>

        </div>

        @if (session('error'))
            <div class="alert alert-danger">
            {{ session('error') }}
             </div>
        @endif

    </div>
@endsection
