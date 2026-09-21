# Product Requirements Document (PRD)
**Project Name**: Virtarastudio  
**Type**: Tech Service Studio & Agency Landing Page with Admin CMS  
**Stack**: Laravel 12 + Vue 3 (Inertia.js) + shadcn-vue + Tailwind CSS + MySQL  
**Target Audience**: Pelaku UMKM, Startup, Perusahaan, Agensi Kreatif, serta Pelajar/Akademisi yang membutuhkan solusi digital mutakhir dan terjangkau.

---

## 1. Executive Summary & Vision

Virtarastudio adalah platform agensi digital yang menawarkan 5 lini jasa teknologi:
1. **Pembuatan Website Murah** (Landing page, Company Profile, Web Application, Toko Online).
2. **Pembuatan App Android** (Aplikasi bisnis, e-commerce, utilitas, custom mobile apps).
3. **Pembuatan Game Android** (Game 2D & 3D, casual games, edukasi, gamifikasi promosi).
4. **Pembuatan App AR (Augmented Reality)** (Filter promosi, visualisasi produk 3D interaktif, arsitektur, katalog interaktif).
5. **Pembuatan App VR (Virtual Reality)** (Tur virtual 360°, simulasi edukasi & pelatihan, visualisasi imersif).

Model konversi utama berfokus pada **Lead Generation cepat via WhatsApp (Konsultasi Gratis)** dengan pesan otomatis yang disesuaikan dengan jasa yang dipilih pengunjung. Website dilengkapi dengan **Admin Panel CMS** yang memungkinkan admin mengelola konten landing page secara dinamis tanpa perlu mengubah kode sumber.

---

## 2. Key Objectives & Metrics

- **Konversi Tinggi**: Tombol CTA WhatsApp yang terintegrasi di setiap section dengan pre-filled text cerdas.
- **Tampilan Modern & Kredibel**: UI profesional bertema clean white background dengan aksen orange energik.
- **Kecepatan & Performa**: SPA responsif dan ringan berbasis Vue 3 + Inertia.js dan Vite.
- **Kemudahan Manajemen**: Admin dapat memperbarui kontak WhatsApp, judul, deskripsi jasa, harga mulai dari, portofolio, dan testimoni.

---

## 3. User Personas & Roles

### 3.1 Public Visitors (Calon Klien)
- Mengakses website melalui desktop ataupun smartphone.
- Mencari informasi jasa, portfolio hasil karya (terutama showcase interaktif Web, Android, Game, AR/VR), serta kisaran harga.
- Menekan tombol CTA "Konsultasi Gratis via WhatsApp" yang langsung membuka chat WhatsApp dengan pesan terformat rapi.

### 3.2 Administrator
- Melakukan login ke halaman admin (`/login`).
- Mengatur konfigurasi umum (Nama website, nomor WhatsApp utama, email, link sosial media).
- Mengelola data Hero Section (Headline, Subheadline, CTA text).
- Mengelola 5 Jasa Utama (Nama jasa, deskripsi, icon/gambar, daftar fitur/benefit, harga mulai dari, pesan default WhatsApp).
- Mengelola Portofolio / Showcase Project (Judul, kategori jasa, gambar thumbnail, link demo).
- Mengelola Testimoni & FAQ.

---

## 4. Core Feature Specifications

### 4.1 Frontend (Public Landing Page)
1. **Navbar Sticky**:
   - Logo Virtarastudio.
   - Navigasi menu: *Beranda*, *Layanan Kami*, *Kelebihan*, *Portofolio*, *FAQ*.
   - CTA Button: "Konsultasi Gratis" (Mengarah ke WhatsApp).
2. **Hero Section**:
   - Headline atraktif & modern.
   - Subheadline penjelas nilai tambah (Cepat, Berkualitas, Harga Terjangkau).
   - 2 Tombol Aksi: Primary Button (Chat WhatsApp) & Secondary Button (Lihat Layanan).
   - Badges kepercayaan: "Konsultasi 100% Gratis", "Pengerjaan Cepat & Bergaransi".
3. **Services Grid (5 Layanan Utama)**:
   - Kartu interaktif untuk 5 layanan:
     - Website Murah
     - App Android
     - Game Android
     - App Augmented Reality (AR)
     - App Virtual Reality (VR)
   - Setiap kartu memiliki: Icon/Ilustrasi, Judul Layanan, Tagline, Poin Keunggulan, Kisaran Harga ("Mulai dari Rp..."), dan Tombol "Konsultasi Layanan Ini".
4. **Interactive AR/VR & Tech Experience Highlights**:
   - Section khusus yang menonjolkan kemampuan teknologi imersif (AR & VR) dan game development sebagai unique selling point (USP) Virtarastudio dibanding agensi konvensional.
5. **Why Choose Us (Keunggulan Kami)**:
   - Harga transparan & ramah kantong.
   - Tim berpengalaman & pengerjaan tepat waktu.
   - Source code terstruktur & bergaransi.
   - Konsultasi dan revisi fleksibel.
6. **Portfolio / Showcase Section**:
   - Filter berdasarkan kategori (Semua, Web, Mobile, Game, AR/VR).
   - Grid kartu portofolio dengan gambar, deskripsi singkat, dan tag teknologi.
7. **Interactive WhatsApp Consultation CTA Banner**:
   - Callout section menjelang footer dengan penawaran konsultasi gratis tanpa komitmen.
8. **FAQ Accordion**:
   - Pertanyaan umum seputar lama pengerjaan, skema pembayaran, garansi, dan persiapan aset.
9. **Footer**:
   - Deskripsi singkat, link menu cepat, kontak resmi (WhatsApp, Email, Lokasi), dan copyright.
10. **Floating WhatsApp Button**:
    - Floating action button di pojok kanan bawah yang selalu terlihat dengan tooltip interaktif.

### 4.2 WhatsApp Link Generator Specification
Format URL WhatsApp:
`https://wa.me/{phone_number}?text={encoded_message}`

Contoh template pesan:
- Tombol Umum: *"Halo Virtarastudio, saya ingin konsultasi gratis untuk proyek digital saya."*
- Jasa Website: *"Halo Virtarastudio, saya tertarik dengan jasa Pembuatan Website. Boleh minta info detail paket dan harganya?"*
- Jasa AR: *"Halo Virtarastudio, saya ingin bertanya tentang pembuatan aplikasi Augmented Reality (AR) untuk kebutuhan proyek saya."*

### 4.3 Backend & Admin Panel (CMS)
1. **Autentikasi**:
   - Menggunakan Laravel Breeze dengan keamanan session guard.
   - Proteksi route `/admin/*` via auth middleware.
2. **Modul Pengaturan Situs (Site Settings)**:
   - Nomor WhatsApp tujuan (format internasional: 628...).
   - Headline & deskripsi hero.
   - Link media sosial (Instagram, LinkedIn, GitHub, TikTok).
3. **Modul Manajemen Jasa (Services)**:
   - CRUD untuk 5 layanan: judul, slug, deskripsi ringkas, icon, fitur poin-poin (JSON array), harga awal, template pesan WhatsApp, status aktif.
4. **Modul Portofolio (Portfolios)**:
   - CRUD item portofolio: judul, kategori (relasi ke service atau enum), gambar, deskripsi, tautan demo/preview.
5. **Modul Testimoni & FAQ**:
   - CRUD ulasan klien dan daftar pertanyaan yang sering diajukan.

---

## 5. Technical Architecture

- **Backend**: Laravel 12 (PHP 8.4)
  - Routing: Web routes terintegrasi dengan Inertia.js.
  - Database: MySQL (Laragon default port 3306).
  - ORM: Eloquent Model dengan relasi terstruktur.
- **Frontend**:
  - Vue 3 Composition API (`<script setup>`).
  - Inertia.js v2 untuk single-page navigation tanpa reload.
  - shadcn-vue untuk komponen UI (Button, Card, Dialog, Accordion, Badge, Input, DropdownMenu).
  - Lucide Vue Icons (`lucide-vue-next`).
  - Tailwind CSS dengan tema custom (White + Vibrant Orange).
- **Security & Performance**:
  - CSRF protection bawaan Laravel.
  - Input sanitization & Form Request Validation.
  - Vite asset code-splitting & gzip compression.
