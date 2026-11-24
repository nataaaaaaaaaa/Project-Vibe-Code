@extends('layouts.app')

@section('judul-bar', 'Daftar langsung di faskes')
@section('kembali', route('antrean.form'))

@section('isi')
    <p class="lead">Tunjukkan layar ini ke petugas pendaftaran supaya data Anda tidak perlu ditulis ulang.</p>

    <div class="card">
        <p class="label">Ringkasan pendaftaran</p>
        <dl class="dl">
            @foreach ($ringkasan as $kunci => $nilai)
                <dt>{{ $kunci }}</dt><dd>{{ $nilai }}</dd>
            @endforeach
        </dl>
        <hr style="border:0;border-top:1px solid var(--line);margin:12px 0">
        <dl class="dl">
            <dt>Peserta</dt><dd>Rani (data contoh)</dd>
            <dt>Kartu</dt><dd>Bawa kartu fisik atau tampilkan kartu digital</dd>
            <dt>Percobaan daring</dt><dd>{{ $percobaan }} kali belum berhasil</dd>
        </dl>
    </div>

    <div class="aksi">
        <a class="btn" href="{{ route('antrean.proses') }}">Coba daftar online lagi</a>
        <a class="btn sec" href="{{ route('beranda') }}">Kembali ke beranda</a>
    </div>
@endsection