# Implementation Roadmap & Task List (Tasks.md)
**Project Name**: Virtarastudio  
**Stack**: Laravel 12 + Vue 3 (Inertia.js) + shadcn-vue + Tailwind CSS + MySQL  

File ini berfungsi sebagai panduan langkah kerja (actionable checklist) bagi AI Agent dan developer untuk mengimplementasikan proyek Virtarastudio secara bertahap dan terstruktur.

---

## Progress Overview
- [x] **Setup Awal Proyek**: Instalasi Laravel 12, Breeze, Inertia.js Vue 3, Laravel Boost, Vite build awal.
- [x] **Phase 1: Konfigurasi Database MySQL & Environment**
- [x] **Phase 2: Setup Komponen UI shadcn-vue & Styling Token**
- [x] **Phase 3: Perancangan Database, Migrasi & Seeder Data Awal**
- [x] **Phase 4: Pembangunan Landing Page Publik (Frontend Vue 3)**
- [x] **Phase 5: Pembangunan Admin Panel CMS (Pengelolaan Konten)**
- [x] **Phase 6: Quality Assurance, Pengujian & Finalisasi**

---

## Phase 1: Konfigurasi Database MySQL & Environment
- [x] **Task 1.1**: Sesuaikan konfigurasi [.env](file:///D:/Website/laragon/www/Virtarastudio/.env) ke MySQL Laragon:
  - `DB_CONNECTION=mysql`
  - `DB_HOST=127.0.0.1`
  - `DB_PORT=3306`
  - `DB_DATABASE=virtarastudio`
  - `DB_USERNAME=root`
  - `DB_PASSWORD=`
- [x] **Task 1.2**: Buat database `virtarastudio` di MySQL jika belum tersedia.
- [x] **Task 1.3**: Jalankan `php artisan migrate` untuk memastikan koneksi MySQL sukses dengan tabel bawaan.

---

## Phase 2: Setup Komponen UI shadcn-vue & Styling Token
- [x] **Task 2.1**: Instal dependensi pendukung shadcn-vue & ikon:
  - `npm install lucide-vue-next @lucide/vue clsx tailwind-merge radix-vue @vueuse/core class-variance-authority`
- [x] **Task 2.2**: Buat file helper utilitas [resources/js/lib/utils.js](file:///D:/Website/laragon/www/Virtarastudio/resources/js/lib/utils.js) (fungsi helper `cn` untuk merging class Tailwind).
- [x] **Task 2.3**: Buat komponen dasar shadcn-vue di `resources/js/Components/ui/`:
  - `button`: Primary (Orange), Outline, Ghost, WhatsApp.
  - `card`: Header, Title, Description, Content, Footer.
  - `badge`: Orange soft pill badges.
  - `accordion`: Untuk FAQ interaktif.
  - `input` & `textarea`: Untuk form admin panel.
- [x] **Task 2.4**: Konfigurasi Tailwind CSS di [tailwind.config.js](file:///D:/Website/laragon/www/Virtarastudio/tailwind.config.js) dan [resources/css/app.css](file:///D:/Website/laragon/www/Virtarastudio/resources/css/app.css) sesuai palet warna di [Style.md](file:///D:/Website/laragon/www/Virtarastudio/Style.md).

---

## Phase 3: Perancangan Database, Migrasi & Seeder Data Awal
- [x] **Task 3.1**: Buat migrasi & model [SiteSetting.php](file:///D:/Website/laragon/www/Virtarastudio/app/Models/SiteSetting.php):
  - Kolom: `key` (string, unique), `value` (text/nullable), `group` (string, default: 'general').
  - Menyimpan nomor WhatsApp utama, email, nama studio, headline hero, subheadline, link Instagram/TikTok/LinkedIn.
- [x] **Task 3.2**: Buat migrasi & model [Service.php](file:///D:/Website/laragon/www/Virtarastudio/app/Models/Service.php):
  - Kolom: `name`, `slug`, `tagline`, `description`, `icon_name`, `features` (json), `starting_price` (string), `whatsapp_template` (text), `sort_order` (integer), `is_active` (boolean).
- [x] **Task 3.3**: Buat migrasi & model [Portfolio.php](file:///D:/Website/laragon/www/Virtarastudio/app/Models/Portfolio.php):
  - Kolom: `service_id` (foreignId/nullable), `title`, `slug`, `category`, `description`, `image_url`, `demo_url`, `is_featured` (boolean), `sort_order`.
- [x] **Task 3.4**: Buat migrasi & model [Testimonial.php](file:///D:/Website/laragon/www/Virtarastudio/app/Models/Testimonial.php):
  - Kolom: `client_name`, `client_role_company`, `avatar_url`, `rating` (integer 1-5), `content`, `is_featured`.
- [x] **Task 3.5**: Buat migrasi & model [Faq.php](file:///D:/Website/laragon/www/Virtarastudio/app/Models/Faq.php):
  - Kolom: `question`, `answer`, `sort_order`, `is_active`.
- [x] **Task 3.6**: Buat Database Seeder komprehensif di [DatabaseSeeder.php](file:///D:/Website/laragon/www/Virtarastudio/database/seeders/DatabaseSeeder.php):
  - Mengisi default data 5 layanan:
    1. *Pembuatan Website Murah* (Company profile, toko online, custom web)
    2. *Pembuatan App Android* (Aplikasi bisnis, marketplace, utility)
    3. *Pembuatan Game Android* (Game 2D/3D casual & edukasi)
    4. *Pembuatan App AR* (Filter interaktif, katalog 3D produk)
    5. *Pembuatan App VR* (Virtual tour 360°, simulasi interaktif)
  - Mengisi akun admin default (`admin@virtarastudio.com` / `password`).
  - Mengisi FAQ, testimoni awal, dan pengaturan WhatsApp.

---

## Phase 4: Pembangunan Landing Page Publik (Frontend Vue 3)
- [x] **Task 4.1**: Rancang komponen [Navbar.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/Navbar.vue):
  - Logo Virtarastudio dengan aksen orange.
  - Link navigasi: Layanan, Keunggulan, Portofolio, FAQ.
  - Tombol CTA cepat: "Konsultasi Gratis" (terhubung langsung ke WhatsApp).
- [x] **Task 4.2**: Rancang komponen [HeroSection.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/HeroSection.vue):
  - Headline modern dengan tipografi bold.
  - Tag pill: *"Solusi Digital Terjangkau & Profesional"*.
  - Subheadline persuasif & 2 tombol aksi (WhatsApp CTA & Jelajahi Layanan).
  - Ilustrasi / Visual mockup modern (Kombinasi Web, Mobile, AR/VR).
- [x] **Task 4.3**: Rancang komponen [ServicesSection.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/ServicesSection.vue):
  - Grid 5 layanan utama.
  - Badges fitur, harga "Mulai dari...", dan tombol langsung: *"Konsultasi Layanan Ini"*.
- [x] **Task 4.4**: Rancang komponen [ImmersiveTechSection.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/ImmersiveTechSection.vue):
  - Showcase khusus kemampuan Game Development, AR (Augmented Reality), dan VR (Virtual Reality) sebagai USP utama Virtarastudio.
- [x] **Task 4.5**: Rancang komponen [WhyUsSection.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/WhyUsSection.vue):
  - Keunggulan: Harga ramah kantong, pengerjaan cepat, teknologi modern, garansi & konsultasi gratis.
- [x] **Task 4.6**: Rancang komponen [PortfolioSection.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/PortfolioSection.vue):
  - Tab filter kategori (Semua, Website, Android, Game, AR, VR).
  - Card portofolio dengan hover preview dan link demo.
- [x] **Task 4.7**: Rancang komponen [TestimonialsSection.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/TestimonialsSection.vue) & [FaqSection.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/FaqSection.vue) (Accordion).
- [x] **Task 4.8**: Rancang komponen [CtaBannerSection.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/CtaBannerSection.vue) & [Footer.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/Footer.vue):
  - Banner penutup yang mengajak konsultasi WhatsApp tanpa komitmen.
- [x] **Task 4.9**: Rancang [FloatingWhatsApp.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Components/Landing/FloatingWhatsApp.vue):
  - Floating button sudut kanan bawah dengan efek pulse dan tooltip: *"Konsultasi Gratis via WhatsApp"*.
- [x] **Task 4.10**: Integrasikan seluruh section di [Welcome.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Pages/Welcome.vue) yang menerima data dinamis dari Laravel [HomeController.php](file:///D:/Website/laragon/www/Virtarastudio/app/Http/Controllers/HomeController.php).

---

## Phase 5: Pembangunan Admin Panel CMS (Pengelolaan Konten)
- [x] **Task 5.1**: Buat Controller [AdminDashboardController.php](file:///D:/Website/laragon/www/Virtarastudio/app/Http/Controllers/Admin/AdminDashboardController.php) & View [Dashboard.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Pages/Admin/Dashboard.vue):
  - Ringkasan statistik (layanan aktif, total portofolio, total FAQ, nomor WhatsApp).
- [x] **Task 5.2**: Buat Controller [AdminSettingController.php](file:///D:/Website/laragon/www/Virtarastudio/app/Http/Controllers/Admin/AdminSettingController.php) & Halaman [Index.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Pages/Admin/Settings/Index.vue):
  - Form edit nomor WhatsApp, email, link sosmed, headline hero, dan teks banner.
- [x] **Task 5.3**: Buat Controller [AdminServiceController.php](file:///D:/Website/laragon/www/Virtarastudio/app/Http/Controllers/Admin/AdminServiceController.php) & Halaman [Index.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Pages/Admin/Services/Index.vue), [Edit.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Pages/Admin/Services/Edit.vue):
  - List layanan, edit judul, deskripsi, harga mulai, poin fitur, dan template pesan WhatsApp per layanan.
- [x] **Task 5.4**: Buat Controller [AdminPortfolioController.php](file:///D:/Website/laragon/www/Virtarastudio/app/Http/Controllers/Admin/AdminPortfolioController.php) & Halaman [Index.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Pages/Admin/Portfolios/Index.vue), [Form.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Pages/Admin/Portfolios/Form.vue):
  - CRUD portofolio projek.
- [x] **Task 5.5**: Buat Controller [AdminFaqController.php](file:///D:/Website/laragon/www/Virtarastudio/app/Http/Controllers/Admin/AdminFaqController.php) & Halaman [Index.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Pages/Admin/Faqs/Index.vue):
  - CRUD pertanyaan & jawaban FAQ.
- [x] **Task 5.6**: Tambahkan menu navigasi admin di [AuthenticatedLayout.vue](file:///D:/Website/laragon/www/Virtarastudio/resources/js/Layouts/AuthenticatedLayout.vue).

---

## Phase 6: Quality Assurance, Pengujian & Finalisasi
- [x] **Task 6.1**: Buat automated feature tests di [LandingPageTest.php](file:///D:/Website/laragon/www/Virtarastudio/tests/Feature/LandingPageTest.php) dan [AdminCmsTest.php](file:///D:/Website/laragon/www/Virtarastudio/tests/Feature/AdminCmsTest.php):
  - Tes halaman landing page dapat diakses publik dengan status 200.
  - Tes link WhatsApp menghasilkan URL yang valid dan ter-encode dengan benar.
  - Tes autentikasi admin dan proteksi route `/admin/*`.
  - Tes update data settings dan services oleh admin.
  - Tes CRUD FAQ dan portofolio.
- [x] **Task 6.2**: Jalankan `vendor/bin/pint --dirty --format agent` untuk memastikan kerapian kode PHP.
- [x] **Task 6.3**: Jalankan `npm run build` untuk memverifikasi tidak ada error sintaks Vue/JS/CSS.
- [x] **Task 6.4**: Jalankan `php artisan test` untuk memastikan semua test lulus 100% (31 passed, 91 assertions).
