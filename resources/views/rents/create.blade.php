@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Data Sewa</h1>
    
    <form action="{{ route('rents.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Pelanggan</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="car_id" class="form-label">Mobil</label>
            <select name="car_id" id="car_id" class="form-control" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->nama_mobil }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
            <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
        </div>

        <div class="form-check mb-3">
            <input type="hidden" name="with_driver" value="0">
            <input type="checkbox" name="with_driver" value="1" id="with_driver" class="form-check-input">
            <label class="form-check-label" for="with_driver">Dengan Sopir</label>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
