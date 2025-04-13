<!-- resources/views/rents/create.blade.php -->

@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>Tambah Data Sewa</h1>

    <form action="{{ route('rents.store') }}" method="POST">
        @csrf

        <div>
            <label>Customer ID:</label>
            <input type="number" name="customer_id" required>
        </div>

        <div>
            <label>Car ID:</label>
            <input type="number" name="car_id" required>
        </div>

        <div>
            <label>Kode Transaksi:</label>
            <input type="text" name="kode_transaksi" required>
        </div>

        <div>
            <label>Tanggal Pinjam:</label>
            <input type="date" name="tanggal_pinjam" required>
        </div>

        <div>
            <label>Tanggal Kembali:</label>
            <input type="date" name="tanggal_kembali" required>
        </div>

        <div>
            <label>Lama Sewa (hari):</label>
            <input type="number" name="lama_sewa" required>
        </div>

        <div>
            <label>Sopir:</label>
            <select name="sopir">
                <option value="ya">Dengan Sopir</option>
                <option value="tidak">Tanpa Sopir</option>
            </select>
        </div>

        <div>
            <label>Biaya:</label>
            <input type="number" name="biaya" required>
        </div>

        <div>
            <label>DP:</label>
            <input type="number" name="dp">
        </div>

        <div>
            <label>Belum Terbayar:</label>
            <input type="number" name="belum_terbayar">
        </div>

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
