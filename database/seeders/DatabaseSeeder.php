<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::firstOrCreate(
            ['email' => 'admin@virtarastudio.com'],
            [
                'name' => 'Admin Virtarastudio',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Site Settings
        $settings = [
            'site_name' => 'Virtarastudio',
            'site_tagline' => 'Studio Solusi Digital, Game & Immersive Tech Terjangkau',
            'whatsapp_number' => '6281234567890',
            'email' => 'kontak@virtarastudio.com',
            'address' => 'Indonesia',
            'hero_badge' => '✨ Solusi Digital Kreatif & Terjangkau',
            'hero_title' => 'Wujudkan Ide Digital Anda Bersama Virtarastudio',
            'hero_subtitle' => 'Jasa pembuatan website murah, aplikasi Android, game interaktif, hingga teknologi masa depan Augmented Reality (AR) & Virtual Reality (VR) dengan konsultasi gratis.',
            'instagram_url' => 'https://instagram.com/virtarastudio',
            'tiktok_url' => 'https://tiktok.com/@virtarastudio',
            'linkedin_url' => 'https://linkedin.com/company/virtarastudio',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        // 3. Services (5 Main Services)
        $services = [
            [
                'name' => 'Pembuatan Website Murah',
                'slug' => 'website-murah',
                'tagline' => 'Desain Modern, Cepat & Ramah Kantong',
                'description' => 'Layanan pembuatan website profesional untuk UMKM, profil perusahaan, toko online, dan landing page dengan performa tinggi dan ramah SEO.',
                'icon_name' => 'Globe',
                'features' => [
                    'Gratis Domain & Hosting Setup',
                    'Desain Responsif (Smartphone & Desktop)',
                    'Optimasi SEO & Cepat Dibuka',
                    'Integrasi Tombol WhatsApp & Form Kontak',
                    'Garansi Maintenance & Panduan Penggunaan',
                ],
                'starting_price' => 'Rp 499.000',
                'whatsapp_template' => 'Halo Virtarastudio, saya tertarik dengan jasa Pembuatan Website Murah. Boleh tahu detail paket dan proses pengerjaannya?',
                'sort_order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Pembuatan App Android',
                'slug' => 'app-android',
                'tagline' => 'Aplikasi Mobile Cepat, Ringan & Stabil',
                'description' => 'Kembangkan aplikasi Android kustom untuk kebutuhan operasional bisnis, kasir/POS, inventaris, e-commerce, maupun startup dengan sistem backend andal.',
                'icon_name' => 'Smartphone',
                'features' => [
                    'Desain UI/UX Eksklusif & Ramah Pengguna',
                    'Support Rilis ke Google Play Store',
                    'Integrasi Database & API Real-time',
                    'Fitur Push Notification Interaktif',
                    'Source Code Bersih & Bergaransi',
                ],
                'starting_price' => 'Rp 1.499.000',
                'whatsapp_template' => 'Halo Virtarastudio, saya ingin membuat Aplikasi Android untuk bisnis saya. Boleh konsultasi gratis terlebih dahulu?',
                'sort_order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Pembuatan Game Android',
                'slug' => 'game-android',
                'tagline' => 'Game Interaktif 2D/3D Seru & Menguntungkan',
                'description' => 'Pembuatan game Android berbasis engine modern untuk promosi brand (advergame), media pembelajaran edukatif sekolah, maupun game komersial publik.',
                'icon_name' => 'Gamepad2',
                'features' => [
                    'Pilihan Grafis 2D & 3D Menarik',
                    'Gameplay Seru & Mekanik Halus',
                    'Integrasi Iklan & In-App Purchase',
                    'Kustom Karakter & Efek Suara Berkualitas',
                    'Optimasi Ringan di Berbagai Tipe Smartphone',
                ],
                'starting_price' => 'Rp 1.999.000',
                'whatsapp_template' => 'Halo Virtarastudio, saya punya ide untuk pembuatan Game Android. Bisa bantu diskusi konsep dan estimasi biayanya?',
                'sort_order' => 3,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Pembuatan App AR (Augmented Reality)',
                'slug' => 'app-ar',
                'tagline' => 'Interaksi Nyata di Dunia Nyata Melalui Layar',
                'description' => 'Aplikasi Augmented Reality interaktif untuk katalog produk 3D, filter promosi sosial media, visualisasi buku pelajaran, dan brosur arsitektur 3D.',
                'icon_name' => 'Scan',
                'features' => [
                    'Visualisasi 3D Interaktif Skala Nyata',
                    'Marker & Markerless (Surface) Tracking',
                    'Cocok untuk Pameran, Edukasi, & Marketing Properti',
                    'Dukungan WebAR maupun Native Mobile AR',
                    'Tampilan Futuristik yang Memukau Calon Klien',
                ],
                'starting_price' => 'Rp 1.899.000',
                'whatsapp_template' => 'Halo Virtarastudio, saya tertarik dengan teknologi Augmented Reality (AR) untuk produk/proyek saya. Boleh jelaskan opsi penerapannya?',
                'sort_order' => 4,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Pembuatan App VR (Virtual Reality)',
                'slug' => 'app-vr',
                'tagline' => 'Simulasi Imersif Masa Depan Tanpa Batas',
                'description' => 'Pengembangan aplikasi Virtual Reality untuk simulasi pelatihan industri kerja berisiko, virtual tour 360° properti & pariwisata, serta media edukasi imersif.',
                'icon_name' => 'Glasses',
                'features' => [
                    'Virtual Tour 360 Derajat Resolusi Tinggi',
                    'Kompatibel Meta Quest, Vive, & Mobile VR',
                    'Interaksi Kontroler 6DoF & Spatial Audio',
                    'Simulasi Prosedur Pelatihan Aman & Terukur',
                    'Pengalaman Visual Imersif Menyerupai Kondisi Asli',
                ],
                'starting_price' => 'Rp 2.499.000',
                'whatsapp_template' => 'Halo Virtarastudio, saya butuh solusi Virtual Reality (VR) untuk virtual tour / simulasi. Boleh jadwalkan sesi konsultasi gratis?',
                'sort_order' => 5,
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(['slug' => $serviceData['slug']], $serviceData);
        }

        // 4. Initial Portfolios
        $webService = Service::where('slug', 'website-murah')->first();
        $androidService = Service::where('slug', 'app-android')->first();
        $gameService = Service::where('slug', 'game-android')->first();
        $arService = Service::where('slug', 'app-ar')->first();
        $vrService = Service::where('slug', 'app-vr')->first();

        $portfolios = [
            [
                'service_id' => $webService?->id,
                'category' => 'website',
                'title' => 'E-Commerce & Company Profile Artisan Coffee',
                'slug' => 'artisan-coffee-web',
                'client_name' => 'Artisan Roastery',
                'description' => 'Website katalog dan pemesanan online kopi dengan desain modern, cepat, dan terintegrasi payment gateway.',
                'image_url' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&auto=format&fit=crop&q=80',
                'demo_url' => 'https://example.com',
                'technologies' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'Payment Gateway'],
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'service_id' => $androidService?->id,
                'category' => 'android',
                'title' => 'Aplikasi POS & Kasir Pintar UMKM',
                'slug' => 'pos-pintar-android',
                'client_name' => 'Koperasi Jaya Makmur',
                'description' => 'Aplikasi Android untuk pencatatan transaksi kasir harian, cetak struk bluetooth, dan laporan keuangan berkala.',
                'image_url' => 'https://images.unsplash.com/photo-1556742049-0a67e5572293?w=800&auto=format&fit=crop&q=80',
                'demo_url' => 'https://example.com',
                'technologies' => ['Android', 'Kotlin', 'SQLite', 'Bluetooth Thermal'],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'service_id' => $gameService?->id,
                'category' => 'game',
                'title' => 'Game Petualangan Angka: Math Odyssey 2D',
                'slug' => 'math-odyssey-game',
                'client_name' => 'EduMedia Studio',
                'description' => 'Game edukasi matematika untuk anak sekolah dasar dengan petualangan interaktif dan papan skor online.',
                'image_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800&auto=format&fit=crop&q=80',
                'demo_url' => 'https://example.com',
                'technologies' => ['Unity', 'C#', '2D Sprite Art', 'Firebase'],
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'service_id' => $arService?->id,
                'category' => 'ar',
                'title' => 'AR Furniture 3D Room Viewer',
                'slug' => 'ar-furniture-viewer',
                'client_name' => 'LivingDecor Studio',
                'description' => 'Aplikasi AR untuk mencoba penempatan furnitur sofa dan meja 3D langsung di ruangan pengguna sebelum membeli.',
                'image_url' => 'https://images.unsplash.com/photo-1633493106185-5b4372554df7?w=800&auto=format&fit=crop&q=80',
                'demo_url' => 'https://example.com',
                'technologies' => ['ARCore', 'WebXR', 'Three.js', 'Blender 3D'],
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'service_id' => $vrService?->id,
                'category' => 'vr',
                'title' => 'Virtual Tour 360° Grand Luxury Residence',
                'slug' => 'vr-luxury-residence',
                'client_name' => 'Nirwana Land Property',
                'description' => 'Pengalaman virtual tour 360 derajat interaktif yang memungkinkan calon pembeli properti menjelajahi rumah secara realistis.',
                'image_url' => 'https://images.unsplash.com/photo-1593508512255-86ab42a8e620?w=800&auto=format&fit=crop&q=80',
                'demo_url' => 'https://example.com',
                'technologies' => ['Unity VR', 'Meta Quest SDK', 'Photogrammetry 360', 'Spatial Audio'],
                'is_featured' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($portfolios as $portfolioData) {
            Portfolio::updateOrCreate(['slug' => $portfolioData['slug']], $portfolioData);
        }

        // 5. Testimonials
        $testimonials = [
            [
                'client_name' => 'Budi Pratama',
                'client_role' => 'Founder',
                'company' => 'Kopi Sentosa',
                'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&auto=format&fit=crop&q=80',
                'rating' => 5,
                'content' => 'Pengerjaan website di Virtarastudio sangat cepat dan harganya sangat bersahabat untuk UMKM seperti kami. Desainnya modern dan penjualan kami naik drastis setelah pasang tombol WhatsApp langsung!',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Siti Nurhaliza',
                'client_role' => 'Marketing Lead',
                'company' => 'EduKids Studio',
                'avatar_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=200&auto=format&fit=crop&q=80',
                'rating' => 5,
                'content' => 'Kami memesan game edukasi Android dan hasilnya melebihi ekspektasi. Respons tim Virtarastudio via WhatsApp sangat cepat dan ramah saat kami konsultasi konsep awal.',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'David Santoso',
                'client_role' => 'Property Director',
                'company' => 'Horizon Land',
                'avatar_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&auto=format&fit=crop&q=80',
                'rating' => 5,
                'content' => 'Aplikasi Virtual Tour VR yang dikembangkan sangat imersif. Calon pembeli kami bisa melihat rumah contoh tanpa harus datang ke lokasi. Sangat direkomendasikan!',
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::updateOrCreate(['client_name' => $testimonialData['client_name']], $testimonialData);
        }

        // 6. FAQs
        $faqs = [
            [
                'question' => 'Bagaimana alur konsultasi gratis di Virtarastudio?',
                'answer' => 'Anda cukup menekan tombol "Konsultasi Gratis via WhatsApp" pada website. Tim kami akan langsung menyapa Anda, mendengarkan kebutuhan proyek Anda, memberikan rekomendasi teknologi yang tepat, serta memberikan estimasi biaya secara transparan tanpa dipungut biaya apapun.',
                'category' => 'Layanan',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama proses pembuatan website atau aplikasi?',
                'answer' => 'Durasi pengerjaan tergantung skala proyek: Website landing page sederhana umumnya selesai dalam 3-5 hari kerja. Aplikasi Android membutuhkan waktu 2-4 minggu, sedangkan Game Android dan aplikasi AR/VR biasanya memakan waktu 3-6 minggu.',
                'category' => 'Pengerjaan',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana sistem pembayaran di Virtarastudio?',
                'answer' => 'Kami menggunakan sistem pembayaran bertahap (Down Payment 50% di awal sebagai tanda jadi dan mulai pengerjaan, lalu pelunasan 50% setelah proyek selesai diuji coba dan siap diserahterimakan).',
                'category' => 'Pembayaran',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah ada garansi setelah proyek selesai?',
                'answer' => 'Tentu saja! Kami memberikan garansi bebas bug (error free) selama 30 hingga 90 hari setelah serah terima proyek, serta panduan lengkap cara mengoperasikan sistem Anda.',
                'category' => 'Garansi',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah saya bisa meminta fitur kustom yang tidak ada di paket?',
                'answer' => 'Sangat bisa. Kami siap membuatkan solusi kustom sesuai kebutuhan spesifik bisnis Anda. Diskusikan saja detailnya dengan kami melalui WhatsApp!',
                'category' => 'Kustomisasi',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faqData) {
            Faq::updateOrCreate(['question' => $faqData['question']], $faqData);
        }
    }
}
