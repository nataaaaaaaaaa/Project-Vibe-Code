@extends('layouts.app')

@section('judul-bar', 'Antrean Online')
@section('kembali', route('beranda'))

@section('isi')
    <p class="lead">Pilih faskes, poli, dan tanggal kunjungan.</p>

    <form method="POST" action="{{ route('antrean.daftar') }}" style="display:flex;flex-direction:column;gap:16px">
        @csrf

        <label class="field">
            <span>Faskes</span>
            <select name="faskes">
                @foreach ($faskes as $i => $nama)
                    <option value="{{ $i }}" @selected(old('faskes', session('pendaftaran.faskes', 0)) == $i)>{{ $nama }}</option>
                @endforeach
            </select>
        </label>

        <label class="field">
            <span>Poli</span>
            <select name="poli">
                @foreach ($poli as $i => $nama)
                    <option value="{{ $i }}" @selected(old('poli', session('pendaftaran.poli', 0)) == $i)>{{ $nama }}</option>
                @endforeach
            </select>
        </label>

        <div class="field">
            <span>Tanggal kunjungan</span>
            <div class="chips">
                @foreach ($tanggal as $i => $teks)
                    <label>
                        <input type="radio" name="tanggal" value="{{ $i }}" @checked(old('tanggal', session('pendaftaran.tanggal', 0)) == $i)>
                        <span>{{ $teks }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        @if ($errors->any())
            <p style="color:var(--err);margin:0">Data belum lengkap. Periksa pilihan Anda lalu coba lagi.</p>
        @endif

        <button class="btn" type="submit">Daftar</button>
    </form>
@endsection