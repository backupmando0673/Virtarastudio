# Implementation Roadmap & Task List (Tasks.md)
**Project Name**: Virtarastudio  
**Stack**: Laravel 12 + Vue 3 (Inertia.js) + shadcn-vue + Tailwind CSS + MySQL  

File ini berfungsi sebagai panduan langkah kerja (actionable checklist) bagi AI Agent dan developer untuk mengimplementasikan proyek Virtarastudio secara bertahap dan terstruktur.

---

## Progress Overview
- [x] **Setup Awal Proyek**: Instalasi Laravel 12, Breeze, Inertia.js Vue 3, Laravel Boost, Vite build awal.
- [ ] **Phase 1: Konfigurasi Database MySQL & Environment**
- [ ] **Phase 2: Setup Komponen UI shadcn-vue & Styling Token**
- [ ] **Phase 3: Perancangan Database, Migrasi & Seeder Data Awal**
- [ ] **Phase 4: Pembangunan Landing Page Publik (Frontend Vue 3)**
- [ ] **Phase 5: Pembangunan Admin Panel CMS (Pengelolaan Konten)**
- [ ] **Phase 6: Quality Assurance, Pengujian & Finalisasi**

---

## Phase 1: Konfigurasi Database MySQL & Environment
- [ ] **Task 1.1**: Sesuaikan konfigurasi [.env](file:///D:/Website/laragon/www/Virtarastudio/.env) ke MySQL Laragon:
  - `DB_CONNECTION=mysql`
  - `DB_HOST=127.0.0.1`
  - `DB_PORT=3306`
  - `DB_DATABASE=virtarastudio`
  - `DB_USERNAME=root`
  - `DB_PASSWORD=`
- [ ] **Task 1.2**: Buat database `virtarastudio` di MySQL jika belum tersedia.
- [ ] **Task 1.3**: Jalankan `php artisan migrate` untuk memastikan koneksi MySQL sukses dengan tabel bawaan.

---

## Phase 2: Setup Komponen UI shadcn-vue & Styling Token
- [ ] **Task 2.1**: Instal dependensi pendukung shadcn-vue & ikon:
  - `npm install lucide-vue-next clsx tailwind-merge radix-vue @vueuse/core class-variance-authority`
- [ ] **Task 2.2**: Buat file helper utilitas `resources/js/lib/utils.js` (fungsi helper `cn` untuk merging class Tailwind).
- [ ] **Task 2.3**: Buat komponen dasar shadcn-vue di `resources/js/Components/ui/`:
  - `button`: Primary (Orange), Outline, Ghost, WhatsApp.
  - `card`: Header, Title, Description, Content, Footer.
  - `badge`: Orange soft pill badges.
  - `accordion`: Untuk FAQ interaktif.
  - `input` & `textarea`: Untuk form admin panel.
  - `dialog` / `modal`: Untuk preview portfolio.
- [ ] **Task 2.4**: Konfigurasi Tailwind CSS di [tailwind.config.js](file:///D:/Website/laragon/www/Virtarastudio/tailwind.config.js) dan [resources/css/app.css](file:///D:/Website/laragon/www/Virtarastudio/resources/css/app.css) sesuai palet warna di [Style.md](file:///D:/Website/laragon/www/Virtarastudio/Style.md).

---

## Phase 3: Perancangan Database, Migrasi & Seeder Data Awal
- [ ] **Task 3.1**: Buat migrasi & model `SiteSetting`:
  - Kolom: `key` (string, unique), `value` (text/nullable), `group` (string, default: 'general').
  - Menyimpan nomor WhatsApp utama, email, nama studio, headline hero, subheadline, link Instagram/TikTok/LinkedIn.
- [ ] **Task 3.2**: Buat migrasi & model `Service`:
  - Kolom: `name`, `slug`, `tagline`, `description`, `icon_name`, `features` (json), `starting_price` (bigInteger/string), `whatsapp_template` (text), `sort_order` (integer), `is_active` (boolean).
- [ ] **Task 3.3**: Buat migrasi & model `Portfolio`:
  - Kolom: `service_id` (foreignId/nullable), `title`, `slug`, `category`, `description`, `image_url`, `demo_url`, `is_featured` (boolean), `sort_order`.
- [ ] **Task 3.4**: Buat migrasi & model `Testimonial`:
  - Kolom: `client_name`, `client_role_company`, `avatar_url`, `rating` (integer 1-5), `content`, `is_featured`.
- [ ] **Task 3.5**: Buat migrasi & model `Faq`:
  - Kolom: `question`, `answer`, `sort_order`, `is_active`.
- [ ] **Task 3.6**: Buat Database Seeder komprehensif:
  - Mengisi default data 5 layanan:
    1. *Pembuatan Website Murah* (Company profile, toko online, custom web)
    2. *Pembuatan App Android* (Aplikasi bisnis, marketplace, utility)
    3. *Pembuatan Game Android* (Game 2D/3D casual & edukasi)
    4. *Pembuatan App AR* (Filter interaktif, katalog 3D produk)
    5. *Pembuatan App VR* (Virtual tour 360°, simulasi interaktif)
  - Mengisi akun admin default (`admin@virtarastudio.com` / password).
  - Mengisi FAQ, testimoni awal, dan pengaturan WhatsApp.

---

## Phase 4: Pembangunan Landing Page Publik (Frontend Vue 3)
- [ ] **Task 4.1**: Rancang komponen `Navbar.vue`:
  - Logo Virtarastudio dengan aksen orange.
  - Link navigasi: Layanan, Keunggulan, Portofolio, FAQ.
  - Tombol CTA cepat: "Konsultasi Gratis" (terhubung langsung ke WhatsApp).
- [ ] **Task 4.2**: Rancang komponen `HeroSection.vue`:
  - Headline modern dengan tipografi bold.
  - Tag pill: *"Solusi Digital Terjangkau & Profesional"*.
  - Subheadline persuasif & 2 tombol aksi (WhatsApp CTA & Jelajahi Layanan).
  - Ilustrasi / Visual mockup modern (Kombinasi Web, Mobile, AR/VR).
- [ ] **Task 4.3**: Rancang komponen `ServicesSection.vue`:
  - Grid 5 layanan utama.
  - Badges fitur, harga "Mulai dari...", dan tombol langsung: *"Konsultasi Layanan Ini"*.
- [ ] **Task 4.4**: Rancang komponen `ImmersiveTechSection.vue`:
  - Showcase khusus kemampuan Game Development, AR (Augmented Reality), dan VR (Virtual Reality) sebagai USP utama Virtarastudio.
- [ ] **Task 4.5**: Rancang komponen `WhyUsSection.vue`:
  - Keunggulan: Harga ramah kantong, pengerjaan cepat, teknologi modern, garansi & konsultasi gratis.
- [ ] **Task 4.6**: Rancang komponen `PortfolioSection.vue`:
  - Tab filter kategori (Semua, Website, Android, Game, AR, VR).
  - Card portofolio dengan hover preview dan link demo.
- [ ] **Task 4.7**: Rancang komponen `TestimonialsSection.vue` & `FaqSection.vue` (Accordion shadcn-vue).
- [ ] **Task 4.8**: Rancang komponen `CtaBannerSection.vue` & `Footer.vue`:
  - Banner penutup yang mengajak konsultasi WhatsApp tanpa komitmen.
- [ ] **Task 4.9**: Rancang `FloatingWhatsApp.vue`:
  - Floating button sudut kanan bawah dengan efek pulse dan tooltip: *"Konsultasi Gratis via WhatsApp"*.
- [ ] **Task 4.10**: Integrasikan seluruh section di `resources/js/Pages/Welcome.vue` yang menerima data dinamis dari Laravel Controller.

---

## Phase 5: Pembangunan Admin Panel CMS (Pengelolaan Konten)
- [ ] **Task 5.1**: Buat Controller `Admin/DashboardController`:
  - Ringkasan statistik (jumlah layanan aktif, jumlah portofolio, info kontak).
- [ ] **Task 5.2**: Buat Controller & Halaman Vue `Admin/SettingsController`:
  - Form edit nomor WhatsApp, email, link sosmed, headline hero, dan teks banner.
- [ ] **Task 5.3**: Buat Controller & Halaman Vue `Admin/ServiceController`:
  - List layanan, edit judul, deskripsi, harga mulai, poin fitur, dan template pesan WhatsApp per layanan.
- [ ] **Task 5.4**: Buat Controller & Halaman Vue `Admin/PortfolioController`:
  - CRUD portofolio + upload gambar showcase ke storage Laravel (`public/storage`).
- [ ] **Task 5.5**: Buat Controller & Halaman Vue `Admin/FaqController`:
  - CRUD pertanyaan & jawaban FAQ.
- [ ] **Task 5.6**: Tambahkan menu navigasi admin di `resources/js/Layouts/AuthenticatedLayout.vue`.

---

## Phase 6: Quality Assurance, Pengujian & Finalisasi
- [ ] **Task 6.1**: Buat automated feature tests di `tests/Feature/`:
  - Tes halaman landing page dapat diakses publik dengan status 200.
  - Tes link WhatsApp menghasilkan URL yang valid dan ter-encode dengan benar.
  - Tes autentikasi admin dan proteksi route `/admin/*`.
  - Tes update data settings dan services oleh admin.
- [ ] **Task 6.2**: Jalankan `vendor/bin/pint --dirty --format agent` untuk memastikan kerapian kode PHP.
- [ ] **Task 6.3**: Jalankan `npm run build` untuk memverifikasi tidak ada error sintaks Vue/JS/CSS.
- [ ] **Task 6.4**: Jalankan `php artisan test` untuk memastikan semua test lulus 100%.
