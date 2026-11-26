# Changelog

Semua perubahan penting pada proyek **Prototipe Pemulihan Error Mobile JKN** dicatat di file ini.

Format mengikuti [Keep a Changelog](https://keepachangelog.com/id-ID/1.1.0/), dan penomoran versi mengikuti [Semantic Versioning](https://semver.org/lang/id/).

## [Belum dirilis]

### Direncanakan
- Uji prototipe dengan peserta (termasuk lansia) untuk mengukur target pada PRD.
- Skenario kegagalan permanen (ubah batas percobaan pemulihan dari 2 menjadi 99).
- File instruksi AI (SKILL.md) jika diminta dosen.

## [0.2.0] - 2026-11-24

### Ditambahkan
- Panel pengembang di samping ponsel: pilihan skenario, log status, dan tombol reset.
- Rute `/reset` untuk mengembalikan skenario dan data session ke awal.
- Rute `/antrean/manual` untuk jalur "Daftar langsung di faskes" berisi ringkasan data pendaftaran.
- Halaman hasil: tiket antrean saat sukses; layar pemulihan saat gagal dengan penyebab, perkiraan waktu, serta tombol Coba Lagi, Tunggu, dan Bantuan.
- Batas waktu loading 15 detik yang berpindah ke layar pemulihan.
- `README.md` berisi PRD dan cara menjalankan proyek.
- `CHANGELOG.md`.

### Diubah
- Prototipe dibangun ulang dari HTML statis menjadi aplikasi Laravel (Blade, controller, session) tanpa basis data.
- Gaya tampilan dipisah ke `public/css/app.css` dengan token warna untuk mode terang dan gelap.

### Diperbaiki
- Galat `bootstrap/cache` tidak bisa ditulis akibat lokasi proyek di folder OneDrive.
- Galat `View [layouts.app] not found` karena file layout belum dibuat.
- Folder `jkn-recovery` terbaca sebagai submodule akibat repositori `.git` bersarang.

## [0.1.0] - 2026-11-23

### Ditambahkan
- Dokumen PRD: latar belakang, persona Rani, tujuan, kebutuhan fungsional, skenario kegagalan, dan kriteria penerimaan.
- Prototipe interaktif berbasis satu file HTML.
- Lima skenario simulasi: `sukses`, `sibuk`, `offline`, `simpan`, dan `timeout`.
- Alur pendaftaran antrean: pilih faskes, poli, tanggal, lalu konfirmasi.

[Belum dirilis]: https://github.com/nataaaaaaaaaa/Project-Vibe-Code/compare/main...HEAD