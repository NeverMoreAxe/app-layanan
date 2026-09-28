# Prompt Google Stitch — Portal Publik SAPA SOSIAL

**Sistem:** SAPA SOSIAL — Satu Pintu Layanan Sosial Kabupaten Blitar
**Instansi:** Dinas Sosial Kabupaten Blitar
**Sumber:** `PRD_SAPA_SOSIAL.md`
**Target:** [Google Stitch](https://stitch.withgoogle.com/)

## Cara pakai

1. Jalankan **Prompt 0** lebih dulu untuk menetapkan gaya visual dan halaman Beranda.
2. Tambahkan halaman lain satu per satu (Prompt 1–8). Prompt yang fokus per halaman biasanya menghasilkan desain lebih konsisten di Stitch.
3. Instruksi desain ditulis dalam bahasa Inggris agar lebih akurat di Stitch, sedangkan seluruh teks antarmuka tetap Bahasa Indonesia.

**Tips:**
- Setelah Prompt 0 jadi, sebut "same design system as the Beranda screen" di prompt berikutnya agar konsisten.
- Bila hasil terlalu ramai, tambahkan: `simplify, fewer elements, more whitespace`.
- Untuk versi mobile, tambahkan: `generate the mobile (375px) version of this screen`.

---

## Prompt 0: Gaya global + Beranda

```
Design a mobile-first responsive public web portal for "SAPA SOSIAL – Satu Pintu Layanan Sosial Kabupaten Blitar", run by Dinas Sosial Kabupaten Blitar (East Java, Indonesia). Citizens use it to apply for social services, submit complaints, and track their ticket online. All UI text in Bahasa Indonesia, simple and friendly, no jargon.

Design style: trustworthy, humane, official-but-approachable government portal. Primary color deep blue (#1E4FA3), warm amber accent (#F59E0B) for key CTAs, white background with soft gray-blue sections (#F5F8FC), dark slate text. Font: Inter or Public Sans, large readable body text (16px+). Rounded cards (12px), soft shadows, clear icons, WCAG AA contrast, touch targets 44px+, designed for low-end phones and older users. Consistent status badges: green = Selesai/Terbit/Aktif Kembali, blue = Dalam Proses, amber = Menunggu/Perlu Perbaikan, red = Ditolak/Tidak Valid, gray = Duplikat/Diarsipkan.

Top navbar: logo placeholder + "SAPA SOSIAL", menu Beranda, Layanan, Pengaduan, Cek Status, Verifikasi Surat, FAQ, and buttons "Masuk" / "Daftar". On mobile: hamburger menu plus a sticky bottom bar with 3 shortcuts (Ajukan Layanan, Pengaduan, Cek Status).

Screen: Beranda (Home).
- Hero: headline "Layanan Sosial Kabupaten Blitar, Satu Pintu", short subtext, a large search bar ("Cari layanan, mis. surat DTSEN, KIS"), and two main buttons "Ajukan Layanan" and "Sampaikan Pengaduan". Below, a prominent inline "Cek Status Tiket" box with a field for Nomor Tiket and a button.
- "Layanan Utama" grid of 3 highlighted cards with icon, short description, estimated time, and "Ajukan" button: Surat Keterangan DTSEN, Reaktivasi KIS/PBI-JK, Pelayanan Rehabilitasi Sosial. Then a smaller row: Layanan Sosial Lainnya, Pengaduan Sosial.
- "Cara Kerja" 4-step strip: Pilih Layanan → Isi Formulir & Unggah Berkas → Dapatkan Nomor Tiket → Pantau Status.
- Banner "Darurat medis? Pengajuan reaktivasi KIS dengan alasan darurat medis diprioritaskan."
- "Informasi Terbaru" cards and a short FAQ accordion (3 items).
- Info strip: alamat kantor, jam layanan, nomor kontak.
- Footer: kontak Dinas Sosial, tautan cepat, "© 2026 Dinas Sosial Kabupaten Blitar".
```

---

## Prompt 1: Informasi Layanan (daftar)

```
Using the same SAPA SOSIAL design system, design the "Informasi Layanan" list page. Header with breadcrumb and a large keyword search bar. Category filter chips (Semua, DTSEN, Kesehatan/KIS, Rehabilitasi Sosial, Bantuan Sosial, Lainnya). Below, a grid of service cards: service name, category tag, 2-line description, waktu pelayanan, and buttons "Lihat Detail" and "Ajukan". A side or top block shows "Paling Sering Dicari" (popular keywords as chips). Include an empty state for "Tidak ada hasil" with a suggestion to file a complaint or ask via contact.
```

---

## Prompt 2: Detail Layanan

```
Using the same design system, design a "Detail Layanan" page for "Surat Keterangan DTSEN". Layout: left main content, right sticky card (on mobile the card moves to a sticky bottom CTA).
Main content sections with clear headings: Deskripsi (what DTSEN is and what the letter is used for: SPMB jalur afirmasi, PIP, KIP Kuliah, bantuan sosial, layanan kesehatan); Persyaratan (checklist: KTP, KK); Alur Pelayanan (vertical stepper: Pengajuan → Pemeriksaan Berkas → Verifikasi Data → Persetujuan Pejabat → Surat Terbit); Waktu Pelayanan; Lokasi & Kontak; Unduh Formulir (file list with version tag "Versi terbaru" and download buttons); FAQ accordion.
Right card: "Ajukan Layanan Ini" primary button, estimated processing time, and a small note "Anda juga bisa dibantu operator kecamatan/desa/Puskesos".
```

---

## Prompt 3: Form Pengajuan DTSEN (multi-step)

```
Using the same design system, design the multi-step application form for "Surat Keterangan DTSEN" with a progress indicator (4 steps): 
1. Tujuan Penggunaan: radio cards (SPMB, PIP, KIP Kuliah, Bantuan Sosial, Kesehatan, Lainnya) plus a text field "Keterangan tujuan" if Lainnya. 
2. Data Pemohon: Nama Lengkap, NIK (16 digit, numeric with helper text), No. KK (16 digit), Alamat, Kecamatan (dropdown), Desa/Kelurahan (dependent dropdown), No. HP/WhatsApp. 
3. Data Orang yang Diterangkan: Nama, NIK, Hubungan dengan Pemohon (dropdown, e.g. Anak, Diri Sendiri), with a "Sama dengan pemohon" checkbox. Then Unggah Dokumen: KTP and KK, each with a drag-and-drop upload area, accepted format hint, file size limit, and preview thumbnail. 
4. Tinjau & Kirim: summary of all data with "Ubah" links, consent checkbox, and "Kirim Pengajuan" button.
Show inline validation states and friendly error messages. Also design the success screen: large check icon, prominent Nomor Tiket (e.g. DTSEN-202610-00012) with a copy button, instruction "Simpan nomor tiket ini dan 4 digit terakhir NIK/No. HP untuk cek status", and buttons "Cek Status" and "Kembali ke Beranda".
```

---

## Prompt 4: Form Reaktivasi KIS/PBI-JK

```
Using the same design system, design the multi-step form "Reaktivasi KIS / PBI-JK" with a progress indicator: 
1. Alasan Reaktivasi: selectable cards (Penyakit Kronis/Katastropik, Kondisi Darurat Medis with a red "Prioritas" badge, Bayi Baru Lahir dari Ibu Peserta PBI, Lainnya). Show an amber info box when "Darurat Medis" is chosen: "Pengajuan Anda akan diprioritaskan." 
2. Data Peserta: Nama, NIK, No. KK, No. Kartu BPJS/KIS, Perkiraan Tanggal Nonaktif (date picker), Alamat, Kecamatan, Desa/Kelurahan, No. HP. 
3. Unggah Dokumen: KTP, KK, Kartu BPJS/KIS, and "Surat Keterangan dari Fasilitas Kesehatan" (marked wajib for medical reasons, with fields Nama Faskes and Nomor Surat). 
4. Tinjau & Kirim. 
Include the success screen with the ticket number (e.g. PBI-202610-00007) and a note that progress includes stages at Kemensos and BPJS Kesehatan.
```

---

## Prompt 5: Pengaduan Sosial

```
Using the same design system, design the "Pengaduan Sosial" form page. Intro text encouraging citizens to report social problems in their neighborhood. Form fields: Kategori Permasalahan (dropdown/cards, e.g. Lansia Terlantar, Penyandang Disabilitas, ODGJ Terlantar, Anak Terlantar, Korban Kekerasan, Bansos Bermasalah, Lainnya), Lokasi Kejadian (Kecamatan and Desa/Kelurahan required, plus optional detail alamat), Deskripsi Permasalahan (textarea with character counter), Unggah Foto/Dokumen (optional, multiple, with thumbnails), Nama Pelapor, No. HP/WhatsApp. Primary button "Kirim Laporan". Side note about privacy: "Data pelapor dijaga kerahasiaannya". Also design the success screen with the report number (e.g. ADU-202610-00004) and "Cek Status Laporan" button.
```

---

## Prompt 6: Cek Status Tiket

```
Using the same design system, design the "Cek Status Tiket" page. Step A (lookup): a centered card with fields Nomor Tiket (placeholder DTSEN-202610-00012) and "4 digit terakhir NIK atau No. HP", and a "Cek Status" button, with a help text explaining where to find the ticket number.
Step B (result): ticket header showing number, service name, submission date, and a large colored status badge. Below, a vertical timeline of stages with completed (green check), current (blue, highlighted) and upcoming (gray) steps, each with date and a short public-friendly note. Design this timeline for "Reaktivasi KIS/PBI-JK": Diajukan → Pemeriksaan Berkas → Verifikasi Kelayakan → Menunggu Persetujuan → Rekomendasi Terbit → Diusulkan ke Kemensos → Disetujui Kemensos → Aktif Kembali di BPJS → Selesai. 
Also show alternate state variants as small cards: "Perlu Perbaikan" (amber alert with petugas note and button "Perbaiki Data/Dokumen"), "Ditolak" (red alert with alasan and tindak lanjut suggestion such as pemutakhiran DTSEN melalui desa), and "Selesai" (green with download button "Unduh Surat" when a letter is issued).
```

---

## Prompt 7: Verifikasi Keaslian Surat

```
Using the same design system, design the public page "Verifikasi Keaslian Surat" (opened from a QR code on the letter, URL /verifikasi/{kode}). Show a manual input field for Kode Verifikasi and a "Periksa" button, plus three result states in separate cards: (1) Valid: green shield icon, "Surat ASLI dan masih berlaku", details (jenis surat, nomor surat, nama yang diterangkan with NIK partially masked like 3505••••••••1234, tanggal terbit, masa berlaku sampai, pejabat penandatangan); (2) Kedaluwarsa: amber, "Surat asli tetapi sudah tidak berlaku"; (3) Tidak Ditemukan: red, "Kode tidak ditemukan atau surat tidak valid" with a contact suggestion.
```

---

## Prompt 8: Login, Daftar, dan Akun Warga

```
Using the same design system, design three screens for citizens: 
1. "Masuk / Daftar" page with tabs; fields Email atau No. HP, Kata Sandi, and registration fields Nama, NIK, No. HP, Kata Sandi; a note that tracking a ticket does not require login. 
2. "Akun Saya – Riwayat Pengajuan": profile summary, tabs (Pengajuan Layanan, Pengaduan), list of cards each with ticket number, service name, date, status badge, and "Lihat Detail". 
3. A "Notifikasi" panel (dropdown or page) with items like "Dokumen perlu diperbaiki" and "Surat DTSEN Anda sudah terbit".
```
