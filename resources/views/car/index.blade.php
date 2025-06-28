@extends('layouts.app')

@section('title', 'Daftar Mobil Tersedia')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Daftar Mobil Tersedia</h2>

    <div class="row">
        @foreach($cars as $car)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($car->foto)
                    <img src="{{ asset('storage/' . $car->foto) }}" class="card-img-top" alt="{{ $car->nama_mobil }}">
                @else
                    <img src="{{ asset('images/default-car.jpg') }}" class="card-img-top" alt="Default Image">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $car->nama_mobil }}</h5>
                    <p class="card-text">
                        {{ $car->jenis_mobil }} | {{ $car->transmisi }}<br>
                        <strong>Rp {{ number_format($car->harga_sewa_per_hari, 0, ',', '.') }}/hari</strong>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('car.edit', $car->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif
                        @endauth
                    </p>
                    <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">Pesan Sekarang</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
