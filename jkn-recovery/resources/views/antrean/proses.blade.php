@extends('layouts.app')

@section('judul-bar', 'Mendaftar antrean')

@section('isi')
    <div class="center">
        <div class="spinner" aria-hidden="true"></div>
        <div class="status" id="status" aria-live="polite">Memeriksa data peserta…</div>
        <p class="lead" id="keterangan">Jangan tutup layar ini. Data Anda sedang diproses.</p>
    </div>

    <div>
        <div class="meter" aria-hidden="true"><b id="meter"></b></div>
        <p class="note" id="waktu">Sudah 0 detik, batas waktu {{ $batas }} detik</p>
    </div>

    <a class="btn sec" href="{{ route('antrean.form') }}">Batalkan dan ubah data</a>

    <script>
        const batas = {{ $batas }};
        const hasilUrl = @json(url('/antrean/hasil'));
        let detik = 0, hasil = null, tunda = null;

        fetch(@json($kirimUrl), {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': @json(csrf_token()), 'Accept': 'application/json' },
        })
            .then(r => r.json())
            .then(d => { hasil = d.hasil; tunda = d.tunda; })
            .catch(() => { hasil = 'offline'; tunda = 2; }); // koneksi putus sungguhan dianggap offline

        const status = document.getElementById('status');
        const ket = document.getElementById('keterangan');
        const waktu = document.getElementById('waktu');
        const meter = document.getElementById('meter');

        const timer = setInterval(() => {
            detik++;
            waktu.textContent = 'Sudah ' + detik + ' detik, batas waktu ' + batas + ' detik';
            meter.style.width = Math.min(100, detik / batas * 100) + '%';

            if (detik === 1) status.textContent = 'Menyimpan pendaftaran…';
            if (detik === 2 && hasil === 'sukses') status.textContent = 'Menerbitkan nomor antrean…';
            if (detik >= 8 && (hasil === 'timeout' || tunda === null)) {
                status.textContent = 'Ini lebih lama dari biasanya…';
                ket.textContent = 'Pendaftaran Anda belum hilang. Kami masih menunggu jawaban dari layanan.';
            }
            if (tunda !== null && detik >= tunda) {
                clearInterval(timer);
                location.href = hasilUrl + '/' + hasil;
            }
        }, 1000);
    </script>
@endsection