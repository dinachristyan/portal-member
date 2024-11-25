@extends('layouts.master')

@section('title', 'Detail Berita 1')

@section('content')

<div class="container mt-4">
    <!-- Banner Gambar Utama -->
    <div class="text-center mb-4">
        <img src="{{ asset('sb-admin-2/img/login/slide1.png') }}" class="img-fluid rounded w-100" style="max-height: 400px;" alt="Banner Merchandise">
    </div>

    <!-- Judul Artikel -->
    <p class="text-left text-muted mb-5">Kamis, 07 November 2024</p>
    <h2 class="text-left text-uppercase font-weight-bold mb-3" style="font-size: 2rem; color: #333;">Kanitra New Merchandise</h2>

    <!-- Konten Artikel -->
    <div class="article-content p-4 bg-white rounded shadow-sm">
        <h5 class="font-weight-bold mb-3">Halo, Sobat Kanitra!</h5>
        <p>
            Kopkar Kanitra mempersembahkan <strong>koleksi merchandise terbaru</strong> yang hadir khusus untuk Sobat Kanitra semua!
        </p>
        <p>
            Koleksi merchandise terbaru ini bisa Sobat Kanitra dapatkan dengan mendatangi Booth Kopkar Kanitra pada acara HUT PT United Tractors Tbk ke-52, tanggal 17 - 18 Oktober 2024 mendatang!
        </p>
        <p>
            Yuk, jangan sampai ketinggalan koleksi merchandise terbaru dari Kopkar Kanitra ya, Sobat Kanitra!
        </p>

        <p>Info lebih lanjut dapat menghubungi:</p>
        <p><strong>0811 508 444</strong> (CS Kanitra)</p>
        <p>Atau klik link yang ada pada bio Kanitra</p>

        <!-- Informasi Kontak -->
        {{-- <div class="mt-4 p-3 bg-light rounded text-center">
            <p>Info lebih lanjut dapat menghubungi:</p>
            <p><strong>0811 508 444</strong> (CS Kanitra)</p>
            <p>Atau klik link yang ada pada bio Kanitra</p>
        </div> --}}

        <p class="font-italic mt-4">KANITRA... Bisa, bisa, BISA!</p>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-4">
        <a href="/dashboard" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</div>

@endsection
