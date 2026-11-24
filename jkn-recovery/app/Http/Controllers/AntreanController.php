<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AntreanController extends Controller
{
    private const SKENARIO = ['sukses', 'sibuk', 'offline', 'simpan', 'timeout'];
    private const BATAS = 15; // detik

    private function catat(string $teks): void
    {
        $log = session('log', []);
        array_unshift($log, now()->format('H:i:s').'  '.$teks);
        session(['log' => array_slice($log, 0, 12)]);
    }

    private function opsi(): array
    {
        $tanggal = [];
        for ($i = 1; $i <= 5; $i++) {
            $tanggal[] = now()->addDays($i)->locale('id')->isoFormat('ddd, D MMM');
        }

        return [
            'faskes' => [
                'Puskesmas Contoh Sejahtera (Faskes Tingkat Pertama)',
                'Klinik Pratama Harapan Sehat (Faskes Tingkat Pertama)',
                'RS Umum Contoh Medika (Rumah sakit)',
            ],
            'poli' => ['Poli Umum', 'Poli Gigi', 'Poli KIA'],
            'tanggal' => $tanggal,
        ];
    }

    private function ringkasan(): array
    {
        $p = session('pendaftaran');
        $o = $this->opsi();

        return [
            'Faskes' => $o['faskes'][$p['faskes']],
            'Poli' => $o['poli'][$p['poli']],
            'Tanggal' => $o['tanggal'][$p['tanggal']],
        ];
    }

    public function beranda()
    {
        return view('beranda', ['nama' => 'Rani']);
    }

    public function skenario(string $nama)
    {
        abort_unless(in_array($nama, self::SKENARIO), 404);
        session(['skenario' => $nama, 'percobaan' => 0]);
        $this->catat('skenario: '.$nama);

        return redirect()->route('beranda');
    }

    public function reset()
    {
        session()->flush();

        return redirect()->route('beranda');
    }

    public function form()
    {
        return view('antrean.form', $this->opsi());
    }

    public function daftar(Request $request)
    {
        $data = $request->validate([
            'faskes' => 'required|integer|between:0,2',
            'poli' => 'required|integer|between:0,2',
            'tanggal' => 'required|integer|between:0,4',
        ]);

        session(['pendaftaran' => $data, 'percobaan' => 0]);
        $this->catat('idle (data pendaftaran disimpan)');

        return redirect()->route('antrean.proses');
    }

    public function proses(Request $request)
    {
        if (! session('pendaftaran')) {
            return redirect()->route('antrean.form');
        }

        return view('antrean.proses', [
            'batas' => self::BATAS,
            'kirimUrl' => route('antrean.kirim', $request->only('tunggu')),
        ]);
    }

    public function kirim(Request $request)
    {
        $skenario = session('skenario', 'sukses');
        $tunggu = $request->boolean('tunggu');

        if (! $tunggu) {
            session(['percobaan' => session('percobaan', 0) + 1]);
        }
        $this->catat($tunggu ? 'loading (menunggu)' : 'loading (percobaan ke-'.session('percobaan').')');

        // Skenario gagal pulih saat Coba Lagi (percobaan ke-2) atau saat memilih Tunggu.
        // Supaya gagal terus, ganti angka 2 di bawah menjadi 99.
        $pulih = $tunggu || session('percobaan') >= 2;

        if ($skenario === 'sukses' || $pulih) {
            session(['nomor' => 'A-0'.random_int(20, 79)]);

            return response()->json(['hasil' => 'sukses', 'tunda' => 3]);
        }

        $tunda = ['sibuk' => 3, 'offline' => 2, 'simpan' => 3, 'timeout' => self::BATAS];

        return response()->json(['hasil' => $skenario, 'tunda' => $tunda[$skenario]]);
    }

    public function hasil(string $status)
    {
        abort_unless(in_array($status, self::SKENARIO), 404);

        if (! session('pendaftaran')) {
            return redirect()->route('antrean.form');
        }

        $this->catat($status === 'sukses' ? 'success' : 'error_'.$status);

        $pesan = [
            'sibuk' => [
                'judul' => 'Layanan sedang ramai',
                'alasan' => 'Pendaftaran Anda belum tersimpan. Layanan sedang menerima banyak permintaan sekaligus.',
                'perkiraan' => 'Coba lagi sekitar 5 menit lagi',
                'tunggu' => false,
            ],
            'offline' => [
                'judul' => 'Sinyal Anda terputus',
                'alasan' => 'Pendaftaran belum terkirim karena koneksi internet terputus. Data yang sudah Anda isi masih aman di sini.',
                'perkiraan' => 'Periksa sinyal, lalu coba lagi',
                'tunggu' => false,
            ],
            'simpan' => [
                'judul' => 'Persetujuan belum tersimpan',
                'alasan' => 'Persetujuan pasien baru belum berhasil disimpan, jadi pendaftaran belum selesai. Anda tidak perlu mengisi data dari awal.',
                'perkiraan' => 'Ketuk Coba Lagi sekarang',
                'tunggu' => false,
            ],
            'timeout' => [
                'judul' => 'Proses lebih lama dari biasanya',
                'alasan' => 'Pendaftaran belum selesai setelah menunggu. Anda bisa menunggu sebentar lagi atau mencoba lagi.',
                'perkiraan' => 'Bisa memakan beberapa menit',
                'tunggu' => true,
            ],
        ];

        return view('antrean.hasil', [
            'status' => $status,
            'pesan' => $pesan[$status] ?? null,
            'ringkasan' => $this->ringkasan(),
            'nomor' => session('nomor', 'A-000'),
        ]);
    }

    public function manual()
    {
        if (! session('pendaftaran')) {
            return redirect()->route('antrean.form');
        }

        return view('antrean.manual', [
            'ringkasan' => $this->ringkasan(),
            'percobaan' => session('percobaan', 0),
        ]);
    }
}