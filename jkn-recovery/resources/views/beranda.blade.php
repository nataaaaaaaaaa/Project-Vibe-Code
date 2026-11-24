@extends('layouts.app')

@section('judul-bar', 'Beranda')

@section('isi')
    <div>
        <p class="lead">Selamat datang,</p>
        <h2 style="font-size:1.4rem">{{ $nama }}</h2>
    </div>

    <div class="menu">
        <a class="tile utama" href="{{ route('antrean.form') }}"><strong>Antrean Online</strong><small>Daftar antrean faskes</small></a>
        <a class="tile" href="#"><strong>Kartu Digital</strong><small>Di luar lingkup prototipe</small></a>
        <a class="tile" href="#"><strong>Cari Faskes</strong><small>Di luar lingkup prototipe</small></a>
        <a class="tile" href="#"><strong>Info Iuran</strong><small>Di luar lingkup prototipe</small></a>
    </div>

    <div class="card soft">
        <p class="label">Coba ini</p>
        <p class="lead" style="color:var(--ink)">Ketuk Antrean Online, isi pendaftaran, lalu lihat apa yang terjadi saat proses gagal.</p>
    </div>
@endsection