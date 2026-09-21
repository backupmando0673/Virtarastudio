# Design System & Style Guidelines (Style.md)
**Project Name**: Virtarastudio  
**Core Theme**: *Art Meets Technology* — Clean White Canvas with Kuning (Seni) & Biru (Teknologi) Accents  
**UI Library**: shadcn-vue + Tailwind CSS + Lucide Icons  

---

## 1. Filosofi Desain: "Seni & Teknologi"

Virtarastudio menggabungkan dua pilar utama dalam setiap solusinya:
- **Kuning / Warm Amber / Gold (SENI)**: Melambangkan kreativitas visual, keindahan desain UI/UX, kehangatan layanan konsultasi, estetika aset game 2D/3D, dan ekspresi artistik.
- **Biru Teknologi / Electric Cyan (TEKNOLOGI)**: Melambangkan ketepatan rekayasa perangkat lunak (*software engineering*), arsitektur backend andal, stabilitas aplikasi Android, serta inovasi imersif mutakhir (AR & VR).
- **Putih Bersih (CRISP WHITE CANVAS)**: Latar belakang putih bersih yang memberikan kesan lapang, elegan, modern, dan memudahkan keterbacaan setiap elemen produk.

Perpaduan ini menciptakan identitas visual yang seimbang: tidak kaku seperti software house teknis biasa, namun juga bukan sekadar agensi desain visual—melainkan **studio perpaduan seni dan teknologi terdepan**.

---

## 2. Palet Warna & Token (Color Tokens)

### 2.1 Pilar Seni: Kuning / Amber / Oranye Hangat
| Token | HEX Code | Tailwind Class | Filosofi & Penggunaan |
| :--- | :--- | :--- | :--- |
| **Amber-50** | `#FFFBEB` | `bg-amber-50` | Soft highlight kontainer seni, badge kreativitas |
| **Amber-100** | `#FEF3C7` | `bg-amber-100`, `border-amber-200` | Tag aset desain & game art |
| **Amber-400** | `#FBBF24` | `text-amber-400` | Bintang rating testimoni, glow aksen |
| **Amber-500 / Orange-500** | `#F59E0B` / `#F97316` | `bg-amber-500`, `text-amber-600` | **Warna Pilar Seni**: Representasi estetika, UI/UX, CTA |
| **Amber-600 / Orange-600** | `#D97706` / `#EA580C` | `hover:bg-amber-600` | State hover elemen hangat |

### 2.2 Pilar Teknologi: Biru Elektrik & Indigo
| Token | HEX Code | Tailwind Class | Filosofi & Penggunaan |
| :--- | :--- | :--- | :--- |
| **Blue-50** | `#EFF6FF` | `bg-blue-50` | Soft highlight fitur teknis, badge engine & coding |
| **Blue-100** | `#DBEAFE` | `bg-blue-100`, `border-blue-200` | Border card teknologi, tag AR/VR/Mobile |
| **Blue-500** | `#3B82F6` | `text-blue-500`, `border-blue-400` | Aksen futuristik, icon box teknologi |
| **Blue-600 (Tech Primary)**| `#2563EB` | `bg-blue-600`, `text-blue-600` | **Warna Pilar Teknologi**: Representasi kestabilan sistem, link teknis |
| **Blue-700** | `#1D4ED8` | `hover:bg-blue-700` | State hover tombol teknologi |
| **Cyan-500** | `#06B6D4` | `text-cyan-500` | Gradien khusus fitur AR & VR |

### 2.3 Netral & Kanvas Putih
| Token | HEX Code | Tailwind Class | Penggunaan |
| :--- | :--- | :--- | :--- |
| **Pure White** | `#FFFFFF` | `bg-white` | Background utama, latar kartu konten |
| **Surface Off-White** | `#F8FAFC` | `bg-slate-50` | Alternating section background |
| **Border Subtle** | `#E2E8F0` | `border-slate-200` | Garis batas navbar, card, pemisah section |
| **Text Primary** | `#0F172A` | `text-slate-900` | Heading tebal, judul jasa, kontras tinggi |
| **Text Secondary** | `#475569` | `text-slate-600` | Deskripsi teks, paragraf penjelas |
| **Text Muted** | `#94A3B8` | `text-slate-400` | Caption, info hak cipta |

### 2.4 Aksentuasi Khusus: WhatsApp
| Token | HEX Code | Tailwind Class | Penggunaan |
| :--- | :--- | :--- | :--- |
| **WhatsApp Green** | `#25D366` | `bg-[#25D366]` | Floating WhatsApp Button & tombol konsultasi langsung |

---

## 3. Kombinasi Visual & Gradien Dual-Tone

1. **Logo Virtarastudio**:
   - `Virtara` dalam warna **Biru Teknologi** (`text-blue-600` atau `text-slate-900` dengan titik biru).
   - `studio` dalam warna **Kuning/Oranye Seni** (`text-amber-500` / `text-orange-500`).
   - Ikon logo mengombinasikan oranye/amber hangat dan biru teknologi.

2. **Headline Hero Dual-Gradient**:
   - Teks gradien memadukan kedua pilar: `bg-gradient-to-r from-amber-500 via-orange-500 to-blue-600 bg-clip-text text-transparent`.

3. **Kategori Layanan Dual-Pillar**:
   - Layanan Berorientasi **Seni & Kreatif** (Desain Web, Game Art): Aksen Kuning/Amber (`bg-amber-50 text-amber-700 border-amber-200`).
   - Layanan Berorientasi **Teknologi & Engine** (Aplikasi Android, AR, VR): Aksen Biru Teknologi (`bg-blue-50 text-blue-700 border-blue-200`).

---

## 4. Tipografi & Hirarki

- **Font Keluarga**: **Figtree** / **Plus Jakarta Sans** (bersih, geometris, modern).
- **Hero Display**: `text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.12]`.
- **Section Heading**: `text-3xl sm:text-4xl font-bold tracking-tight text-slate-900`.
- **Subheadline**: `text-lg sm:text-xl text-slate-600 leading-relaxed`.
- **Card Title**: `text-lg sm:text-xl font-bold text-slate-900`.

---

## 5. Pola Komponen (shadcn-vue style)

### 5.1 Tombol (Button)
- **Primary CTA Button (Hangat / Seni)**:
  `bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold shadow-md shadow-orange-500/20 rounded-xl px-6 py-3 transition-all duration-200 hover:-translate-y-0.5`
- **Secondary / Tech Button (Biru Teknologi)**:
  `border border-blue-200 bg-blue-50/50 hover:bg-blue-100/70 text-blue-700 font-semibold rounded-xl px-6 py-3 transition-all duration-200`
- **WhatsApp Direct**:
  `bg-[#25D366] hover:bg-[#20ba59] text-white font-bold rounded-xl px-5 py-2.5 shadow-md shadow-green-500/20`

### 5.2 Kartu (Cards)
- Border halus `border-slate-200/90`, latar putih `bg-white`, sudut `rounded-2xl`, dengan efek hover bayangan lembut bergaya tech-modern.

### 5.3 Kebijakan Akses Admin
- **Sembunyikan seluruh tautan / tombol Admin Login dari publik**.
- Tamu (*guests*) tidak melihat opsi login di navbar maupun footer.
- Administrator langsung mengakses URL rahasia `/login` secara manual di browser.
