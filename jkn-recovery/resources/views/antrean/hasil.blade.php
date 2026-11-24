@extends('layouts.app')

@section('judul-bar', $status === 'sukses' ? 'Antrean Online' : 'Pendaftaran belum selesai')

@section('isi')
@if ($status === 'sukses')
<div class="center">
    <div class="ikon" aria-hidden="true">✓</div>
    <h3 style="font-size:1.4rem">Pendaftaran berhasil</h3>
    <p class="lead">Nomor antrean Anda</p>
    <div class="tiket">{{ $nomor }}</div>
</div>

<div class="card">
    <dl class="dl">
        @foreach ($ringkasan as $kunci => $nilai)
        <dt>{{ $kunci }}</dt>
        <dd>{{ $nilai }}</dd>
        @endforeach
    </dl>
</div>

<p class="note">Nomor dan jadwal di layar ini adalah contoh.</p>
<a class="btn" href="{{ route('beranda') }}">Selesai</a>
@else
<div class="errhead">
    <div class="lencana" aria-hidden="true">!</div>
    <h3>{{ $pesan['judul'] }}</h3>
</div>

<p style="margin:0;font-size:1.05rem">{{ $pesan['alasan'] }}</p>

<div class="chips2">
    <span class="pill warn">{{ $pesan['perkiraan'] }}</span>
    <span class="pill">Data Anda masih tersimpan di sini</span>
</div>

<div class="card soft">
    <p class="label">Data pendaftaran Anda</p>
    <dl class="dl">
        @foreach ($ringkasan as $kunci => $nilai)
        <dt>{{ $kunci }}</dt>
        <dd>{{ $nilai }}</dd>
        @endforeach
    </dl>
</div>

@if (in_array($status, ['sibuk', 'timeout']))
<a class="btn sec" href="{{ route('antrean.manual') }}">Daftar langsung di faskes</a>
@endif

<div class="aksi">
    @if ($pesan['tunggu'])
    <a class="btn" href="{{ route('antrean.proses', ['tunggu' => 1]) }}">Tunggu sebentar lagi</a>
    <a class="btn sec" href="{{ route('antrean.proses') }}">Coba Lagi</a>
    @else
    <a class="btn" href="{{ route('antrean.proses') }}">Coba Lagi</a>
    @endif

    <details class="bantuan">
        <summary>Butuh bantuan?</summary>
        <ol>
            <li>Periksa sinyal internet Anda.</li>
            <li>Tunggu sekitar 5 menit, lalu ketuk Coba Lagi. Data Anda tidak perlu diisi ulang.</li>
            <li>Jika tetap gagal, daftar langsung di faskes dan tunjukkan ringkasan pendaftaran dari aplikasi.</li>
        </ol>
        <p class="note">Untuk bantuan resmi, hubungi layanan pelanggan BPJS Kesehatan lewat aplikasi resmi.</p>
    </details>
</div>
@endif
@endsection