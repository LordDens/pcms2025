@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="section">
        <div class="container text-center">
            <h1>Selamat Datang di Juragan Rental</h1>
            <p>Sewa mobil dengan mudah, cepat, dan terpercaya.</p>

            <a href="{{ route('rents.index') }}" class="btn btn-primary mt-3">Lihat Data Sewa</a>
        </div>
    </div>
@endsection
