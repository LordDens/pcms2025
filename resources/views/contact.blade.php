@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Hubungi Kami</h4>
        </div>
        <div class="card-body">
            <p>Jika Anda memiliki pertanyaan, silakan hubungi kami melalui informasi berikut:</p>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Nama Pemilik:</strong> Juragan Rental Jogja
                </li>
                <li class="list-group-item">
                    <strong>Alamat:</strong> Jl. Kaliurang KM 7, Yogyakarta, Indonesia
                </li>
                <li class="list-group-item">
                    <strong>Telepon:</strong> +62 812-3456-7890
                </li>
                <li class="list-group-item">
                    <strong>Email:</strong> info@juraganrental.com
                </li>
                <li class="list-group-item">
                    <strong>Jam Operasional:</strong> Setiap hari, 06.00 - 20.00 WIB
                </li>
                <li class="list-group-item">
                    <strong>WhatsApp:</strong>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-sm">
                        <i class="fa fa-whatsapp"></i> Chat di WhatsApp
                    </a>
                </li>
            </ul>

            <hr>

            <h5>Lokasi Kami:</h5>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe 
                    class="embed-responsive-item" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.277!2d110.403!3d-7.8637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a590c4e4e1f41%3A0x9a13b6cbf16a5a42!2sJl.%20Kaliurang%20KM%207%2C%20Yogyakarta!5e0!3m2!1sid!2sid!4v1719450000000!5m2!1sid!2sid" 
                    width="100%" 
                    height="300" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection
