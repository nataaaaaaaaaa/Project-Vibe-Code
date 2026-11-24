# PRD: Prototipe Pemulihan Error Mobile JKN

**Penulis:** Ahmad Aditia Pranata · **Tanggal:** 23 November 2026 · **Mata kuliah:** Rekayasa Interaksi

Produk ini adalah prototipe fitur yang membantu peserta JKN-KIS tetap tahu apa yang terjadi dan apa langkah berikutnya saat pendaftaran antrean di Mobile JKN gagal atau lambat, sehingga mereka tidak perlu menebak-nebak lalu beralih ke jalur manual.

> Prototipe konsep untuk tugas kuliah. Bukan aplikasi resmi BPJS Kesehatan. Semua data dan teks pesan adalah contoh.

## Daftar isi

1. [Latar belakang dan masalah](#latar-belakang-dan-masalah)
2. [Pengguna target](#pengguna-target)
3. [Tujuan dan ukuran keberhasilan](#tujuan-dan-ukuran-keberhasilan)
4. [Lingkup](#lingkup)
5. [Alur pengguna](#alur-pengguna)
6. [Kebutuhan fungsional](#kebutuhan-fungsional)
7. [Skenario kegagalan dan contoh pesan](#skenario-kegagalan-dan-contoh-pesan)
8. [Kebutuhan non-fungsional](#kebutuhan-non-fungsional)
9. [Kriteria penerimaan](#kriteria-penerimaan)
10. [Panduan teknis dan vibe coding](#panduan-teknis-dan-vibe-coding)
11. [Cara menjalankan](#cara-menjalankan)
12. [Asumsi, risiko, dan pertanyaan terbuka](#asumsi-risiko-dan-pertanyaan-terbuka)

## Latar belakang dan masalah

Peserta Mobile JKN yang gagal mendaftar antrean online tidak mendapat penjelasan penyebab maupun langkah berikutnya, sehingga mereka menebak sendiri, mengulang, lalu datang langsung ke faskes. Temuan ini berasal dari kuesioner terbuka (3 responden, usia 32–39 tahun) dan audit UX pada Worksheet 1–7.

- Layar berputar tanpa batas, kosong, atau kembali ke dialog yang sama tanpa pesan (U1, U2, U3).
- Pesan error hanya berbunyi "terjadi kesalahan, silakan coba beberapa saat lagi" tanpa penyebab dan perkiraan waktu (U1).
- Pengguna ragu apakah persetujuan yang sudah dikirim tersimpan (U3).
- Ketiga responden akhirnya beralih ke jalur manual: daftar langsung di faskes atau memakai kartu fisik.

Moment of Truth ada pada konfirmasi pendaftaran yang berputar tanpa hasil, saat pengguna memutuskan meninggalkan aplikasi.

**Design Challenge:** bagaimana memberi umpan balik yang jelas dan langkah pemulihan yang mudah dipahami saat fitur gagal atau lambat.

## Pengguna target

**Persona Rani**, 35 tahun, peserta JKN-KIS dewasa (rentang responden 32–39 tahun). Pekerjaan tidak ditanyakan di kuesioner.

- **Tujuan:** mengurus antrean dan kartu JKN lewat HP tanpa datang dua kali.
- **Perilaku:** memakai Mobile JKN 2–4 kali sebulan; saat gagal restart aplikasi, cek sinyal, coba ulang, lalu datang langsung ke faskes.
- **Konteks:** di rumah sebelum berobat atau di loket faskes; sering di awal bulan dan pagi hari saat antrean ramai.
- **Kemampuan teknologi:** menengah; tidak bisa mendiagnosis penyebab teknis.
- **Kutipan:** "Capek karena aplikasi ini harusnya mempermudah tapi pas dibutuhkan malah error" (U1).

## Tujuan dan ukuran keberhasilan

Tujuan produk: pengguna memahami apa yang terjadi saat proses gagal dan tahu langkah berikutnya tanpa menebak. Angka target di bawah adalah usulan untuk uji prototipe dan bisa disesuaikan.

| Tujuan | Ukuran | Target (usulan) |
| --- | --- | --- |
| Pengguna paham penyebab dan langkah berikutnya | Persentase peserta uji yang menjelaskan isi layar error dengan benar tanpa bantuan | 80% atau lebih |
| Pengguna tidak terjebak di layar yang sama | Persentase peserta uji yang memilih Coba Lagi atau jalur alternatif dalam 30 detik setelah gagal | 90% atau lebih |
| Pengguna yakin data tersimpan | Persentase peserta uji yang menyebut dengan benar status data setelah gagal | 80% atau lebih |
| Pengalaman terasa lebih tenang | Penilaian kualitatif dari wawancara singkat setelah uji | Tema "bingung" dan "capek" berkurang dibanding temuan awal |

## Lingkup

Produk ini prototipe konsep yang bisa diklik, bukan pengganti aplikasi resmi Mobile JKN.

**Termasuk:**

- Alur simulasi pendaftaran antrean (pilih faskes, poli, tanggal, konfirmasi).
- Empat skenario kegagalan dan layar pemulihan error untuk masing-masing.
- Panel pengembang untuk memicu skenario sukses atau gagal saat demo.

**Tidak termasuk:**

- Integrasi dengan sistem atau API BPJS Kesehatan yang asli.
- Data peserta nyata, login asli, dan pembayaran iuran.
- Fitur kartu digital dan cari faskes berbasis lokasi (bisa jadi pengembangan lanjutan).

## Alur pengguna

1. Rani membuka prototipe dan masuk ke beranda dengan akun simulasi.
2. Ia membuka menu Antrean Online, lalu memilih faskes, poli, dan tanggal.
3. Ia menekan Daftar; sistem menampilkan konfirmasi pasien baru dan Rani menekan Setuju.
4. Layar menampilkan indikator proses dengan teks status, misalnya "Menyimpan pendaftaran…".
5. Jika berhasil, Rani melihat nomor antrean dan ringkasan pendaftaran.
6. Jika gagal atau lebih dari 15 detik, muncul layar pemulihan error dengan penyebab, perkiraan waktu, dan pilihan aksi: Coba Lagi, Daftar langsung di faskes, atau Bantuan.
7. Coba Lagi mengulang proses tanpa mengisi ulang data; Daftar langsung di faskes menampilkan ringkasan data untuk ditunjukkan ke petugas.

## Kebutuhan fungsional

Prioritas memakai Must (wajib), Should (sebaiknya), dan Could (jika waktu ada).

| ID | Kebutuhan | Prioritas | Dasar |
| --- | --- | --- | --- |
| FR-1 | Indikator proses dengan teks status yang menjelaskan apa yang sedang dikerjakan | Must | U1, U3; audit W1 |
| FR-2 | Batas waktu loading 15 detik yang berakhir dengan layar pesan, bukan putaran tanpa akhir | Must | U1, U3 |
| FR-3 | Pesan error berbahasa awam yang memuat penyebab, perkiraan waktu, dan langkah berikutnya | Must | U1, U3 |
| FR-4 | Tombol Coba Lagi yang mempertahankan data yang sudah diisi | Must | U3 |
| FR-5 | Status penyimpanan persetujuan: "Menyimpan…" lalu hasil berhasil atau gagal yang tegas; tidak kembali ke dialog yang sama tanpa penjelasan | Must | U3 |
| FR-6 | Jalur alternatif "Daftar langsung di faskes" dengan ringkasan data pendaftaran | Should | U1, U2 |
| FR-7 | Tombol Bantuan pada layar error | Should | U1 |
| FR-8 | Info kondisi layanan atau jam ramai di layar awal | Could | U1 |
| FR-9 | Panel pengembang untuk memicu skenario sukses dan gagal saat demo | Must | Kebutuhan uji prototipe |

## Skenario kegagalan dan contoh pesan

Empat skenario disimulasikan. Teks pesan di bawah adalah usulan rancangan, bukan teks resmi BPJS Kesehatan.

| Skenario | Contoh pesan di layar | Tombol |
| --- | --- | --- |
| Layanan sibuk | "Layanan sedang ramai. Pendaftaran Anda belum tersimpan. Coba lagi sekitar 5 menit lagi, atau daftar langsung di faskes." | Coba Lagi, Daftar di Faskes, Bantuan |
| Tidak ada koneksi | "Sinyal Anda terputus. Data yang sudah Anda isi masih aman di sini. Periksa sinyal, lalu coba lagi." | Coba Lagi, Bantuan |
| Gagal menyimpan persetujuan | "Persetujuan Anda belum tersimpan. Ketuk Coba Lagi; Anda tidak perlu mengisi data dari awal." | Coba Lagi, Bantuan |
| Loading lebih dari 15 detik | "Proses ini lebih lama dari biasanya. Anda bisa menunggu, mencoba lagi, atau daftar langsung di faskes." | Tunggu, Coba Lagi, Daftar di Faskes |

## Kebutuhan non-fungsional

- **Bahasa:** Indonesia sehari-hari, tanpa kode teknis; kalimat pesan error singkat.
- **Keterbacaan:** ukuran teks minimal 16 px dan tombol minimal 48 px agar nyaman bagi lansia.
- **Aksesibilitas:** kontras warna memenuhi WCAG AA; status tidak hanya dibedakan lewat warna.
- **Perangkat:** tampil baik di layar HP lebar 360–430 px, bisa dibuka di browser tanpa instalasi.
- **Privasi:** hanya data dummy; tidak mengumpulkan data pribadi nyata.
- **Performa:** halaman tampil kurang dari 3 detik; kegagalan hanya disimulasikan, bukan benar-benar terhubung ke server.

## Kriteria penerimaan

Prototipe dianggap selesai jika semua poin berikut terpenuhi.

- [ ] Alur pendaftaran antrean bisa dijalankan dari beranda sampai nomor antrean.
- [ ] Setiap proses menampilkan indikator dengan teks status.
- [ ] Loading lebih dari 15 detik otomatis berpindah ke layar pemulihan.
- [ ] Keempat skenario kegagalan menampilkan pesan awam, perkiraan waktu, dan tombol aksi yang sesuai.
- [ ] Coba Lagi tidak menghapus data yang sudah diisi.
- [ ] Jalur Daftar langsung di faskes menampilkan ringkasan data pendaftaran.
- [ ] Panel pengembang bisa memicu skenario sukses dan gagal.
- [ ] Tampilan nyaman di layar HP dan lolos cek kontras serta ukuran teks.

## Panduan teknis dan vibe coding

Bagian ini dipakai sebagai arahan saat meminta AI membuat kodenya.

- **Teknologi:** Laravel (PHP 8.2 atau lebih baru) dengan Blade dan CSS biasa; tanpa basis data. Data pendaftaran, skenario aktif, dan log status disimpan di session.
- **Simulasi kegagalan:** controller menentukan hasil sesuai skenario yang dipilih (`sukses`, `sibuk`, `offline`, `simpan`, `timeout`), lalu halaman loading menunggu sesuai lama yang ditentukan sebelum berpindah ke halaman hasil.
- **Status layar:** idle, loading, success, error_sibuk, error_offline, error_simpan, dan error_timeout; setiap perpindahan dicatat di panel pengembang.
- **Urutan membangun:** kerangka layar dan layout, alur sukses, satu skenario gagal pada satu waktu, lalu panel pengembang dan perapian tampilan.
- **Gaya:** hijau dan putih bersih, teks besar, tombol lebar penuh, satu aksi utama per layar.
- **Aturan kerja AI:** minta AI mengerjakan satu layar atau satu skenario per langkah, dan cocokkan hasilnya dengan kriteria penerimaan sebelum lanjut.
- **Skill pendamping (jika diminta dosen):** ringkas aturan di atas, yaitu gaya, teks pesan error, dan standar ukuran, menjadi satu file instruksi yang dipakai ulang di setiap langkah.

## Cara menjalankan

Prasyarat: PHP 8.2 atau lebih baru dan Composer.

```bash
cd jkn-recovery
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Di PowerShell, ganti `cp .env.example .env` dengan `copy .env.example .env`. Lalu buka `http://127.0.0.1:8000`.

Skenario bisa dipilih lewat panel pengembang di samping ponsel, atau langsung lewat alamat `/skenario/sukses`, `/skenario/sibuk`, `/skenario/offline`, `/skenario/simpan`, dan `/skenario/timeout`.

## Asumsi, risiko, dan pertanyaan terbuka

**Asumsi**

- Produk berupa prototipe konsep, bukan aplikasi resmi BPJS; topik dilanjutkan dari Worksheet 1–7 karena belum ada teks penugasan.
- Target angka keberhasilan adalah usulan untuk uji prototipe.
- Teks pesan error adalah rancangan penulis, bukan teks resmi.

**Risiko**

- Data riset hanya dari 3 responden usia 32–39 tahun dan belum mewakili lansia.
- Kegagalan hanya disimulasikan, jadi hasil uji belum menggambarkan kondisi sistem yang sebenarnya.

**Pertanyaan terbuka**

- [ ] Apakah dosen punya template atau format PRD yang harus diikuti?
- [ ] Apakah topik harus tetap Mobile JKN, atau bebas?
- [ ] Apa maksud "PRD + skill": skill untuk AI (file instruksi) atau keterampilan yang dipakai?
- [ ] Apakah kodenya nanti benar-benar harus dibuat, atau cukup PRD?