@php
    $daftarSkenario = [
        'sukses'  => ['Berhasil', 'Alur normal sampai nomor antrean'],
        'sibuk'   => ['Layanan sibuk', 'Pendaftaran belum tersimpan, coba lagi sekitar 5 menit'],
        'offline' => ['Tidak ada koneksi', 'Sinyal terputus, data tetap tersimpan di layar'],
        'simpan'  => ['Gagal menyimpan persetujuan', 'Kasus konfirmasi pasien baru yang berputar'],
        'timeout' => ['Loading terlalu lama', 'Batas waktu 15 detik, lalu layar pemulihan'],
    ];
    $aktif = session('skenario', 'sukses');
    $log = session('log', []);
@endphp
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Pemulihan Error JKN')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="stage">
        <div class="phone">
            <div class="bar">
                @hasSection('kembali')
                    <a href="@yield('kembali')" aria-label="Kembali">←</a>
                @endif
                <h2>@yield('judul-bar', 'Mobile JKN (contoh)')</h2>
            </div>
            <main class="screen">
                @yield('isi')
            </main>
        </div>

        <aside class="panel" aria-label="Panel pengembang">
            <h2>Panel pengembang</h2>
            <p class="note">Prototipe konsep untuk tugas UX. Bukan aplikasi resmi BPJS Kesehatan; semua data dan teks pesan adalah contoh. Pilih skenario, lalu jalankan alur Antrean Online di ponsel.</p>

            <div class="card">
                <p class="label">Skenario</p>
                @foreach ($daftarSkenario as $kode => [$nama, $ket])
                    <a class="opsi {{ $aktif === $kode ? 'aktif' : '' }}" href="{{ route('skenario', $kode) }}" @if ($aktif === $kode) aria-current="true" @endif>
                        <strong>{{ $nama }}</strong>
                        <small>{{ $ket }}</small>
                    </a>
                @endforeach
            </div>

            <div class="card">
                <p class="label">Status sistem</p>
                <ul class="log" aria-label="Catatan kejadian">
                    @forelse ($log as $baris)
                        <li>{{ $baris }}</li>
                    @empty
                        <li>idle</li>
                    @endforelse
                </ul>
            </div>

            <a class="btn sec" href="{{ route('reset') }}">Mulai ulang prototipe</a>
        </aside>
    </div>
</body>
</html>