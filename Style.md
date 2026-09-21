# Design System & Style Guidelines (Style.md)
**Project Name**: Virtarastudio  
**Core Theme**: Crisp Modern White with Vibrant Energetic Orange Accents  
**UI Library**: shadcn-vue + Tailwind CSS + Lucide Icons  

---

## 1. Design Philosophy

Website Virtarastudio mengusung estetika **modern, clean, ramah, dan futuristik**. Kombinasi latar belakang putih bersih (*crisp white*) dengan aksen warna oranye (*vibrant orange*) memberikan kesan inovatif, hangat, dan mendorong aksi pengguna (konversi tinggi). Elemen 3D, AR, dan VR ditampilkan dengan card glassmorphic halus, gradien lembut, dan micro-interaction yang responsif.

---

## 2. Color Palette & Tokens

### 2.1 Brand Colors (Orange Accent)
| Token | HEX Code | Tailwind Class | Keterangan & Penggunaan |
| :--- | :--- | :--- | :--- |
| **Orange-50** | `#FFF7ED` | `bg-orange-50`, `text-orange-50` | Background badge halus, soft container highlight |
| **Orange-100** | `#FFEDD5` | `bg-orange-100`, `border-orange-100` | Hover badge, border halus |
| **Orange-200** | `#FED7AA` | `border-orange-200` | Border card highlight & form focus ring |
| **Orange-400** | `#FB923C` | `text-orange-400` | Gradient highlight, secondary glow |
| **Orange-500 (Primary)** | `#F97316` | `bg-orange-500`, `text-orange-500` | **Warna utama tombol CTA**, active link, icon badge |
| **Orange-600 (Hover)** | `#EA580C` | `hover:bg-orange-600` | State hover tombol utama |
| **Orange-700 (Active)** | `#C2410C` | `active:bg-orange-700` | State klik / pressed tombol |

### 2.2 Neutral & Background Colors
| Token | HEX Code | Tailwind Class | Penggunaan |
| :--- | :--- | :--- | :--- |
| **White (Pure)** | `#FFFFFF` | `bg-white` | Background utama halaman & latar belakang kartu |
| **Surface Off-White** | `#F8FAFC` | `bg-slate-50` | Background section sekunder (alternating section) |
| **Border Subtle** | `#E2E8F0` | `border-slate-200` | Garis batas navbar, card, input, separator |
| **Text Primary** | `#0F172A` | `text-slate-900` | Heading utama, judul jasa, navigasi aktif |
| **Text Secondary** | `#475569` | `text-slate-600` | Paragraf deskripsi, body text reguler |
| **Text Muted** | `#94A3B8` | `text-slate-400` | Placeholder input, caption, footer note |

### 2.3 Success / WhatsApp Accent
| Token | HEX Code | Tailwind Class | Penggunaan |
| :--- | :--- | :--- | :--- |
| **WhatsApp Green** | `#25D366` | `bg-[#25D366]` | Floating WhatsApp Button & ikon WhatsApp resmi |
| **WhatsApp Dark** | `#20BA59` | `hover:bg-[#20ba59]` | State hover tombol WhatsApp |

---

## 3. Typography Hierarchy

Menggunakan font modern sans-serif: **Plus Jakarta Sans** atau **Figtree**.

- **Display / Hero Heading**: `text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.15]`
- **Section Heading (H2)**: `text-3xl sm:text-4xl font-bold tracking-tight text-slate-900`
- **Card Heading (H3)**: `text-xl font-semibold text-slate-900`
- **Subheadline**: `text-lg sm:text-xl text-slate-600 font-normal leading-relaxed`
- **Body Regular**: `text-base text-slate-600 leading-relaxed`
- **Small / Caption**: `text-sm text-slate-500`
- **Badge / Micro-copy**: `text-xs font-semibold tracking-wide uppercase`

---

## 4. Component Design Patterns

### 4.1 Buttons (shadcn-vue style)
1. **Primary Button (CTA)**:
   - Class: `inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-orange-500 hover:bg-orange-600 text-white font-medium text-sm transition-all duration-200 shadow-md shadow-orange-500/20 hover:shadow-lg hover:shadow-orange-500/30 hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98]`
2. **Secondary / Outline Button**:
   - Class: `inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-slate-200 bg-white hover:bg-orange-50 hover:border-orange-200 text-slate-800 hover:text-orange-600 font-medium text-sm transition-all duration-200`
3. **Ghost Button**:
   - Class: `inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg text-slate-600 hover:text-orange-600 hover:bg-orange-50/60 transition-colors duration-150`
4. **WhatsApp Direct Button**:
   - Class: `inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-[#25D366] hover:bg-[#20ba59] text-white font-semibold text-sm shadow-md shadow-green-500/20 transition-all duration-200 hover:scale-105`

### 4.2 Cards & Surface
- **Standard Service Card**:
  - Class: `group relative bg-white rounded-2xl border border-slate-200/80 p-6 md:p-8 transition-all duration-300 hover:border-orange-300 hover:shadow-xl hover:shadow-orange-500/5 hover:-translate-y-1`
- **Card Icon Box**:
  - Class: `w-12 h-12 rounded-xl bg-orange-100/70 text-orange-600 flex items-center justify-center group-hover:bg-orange-500 group-hover:text-white transition-all duration-300`
- **Featured / Highlighted Card**:
  - Class: `relative bg-gradient-to-b from-orange-50/50 to-white rounded-2xl border-2 border-orange-400 p-6 md:p-8 shadow-lg shadow-orange-500/10`

### 4.3 Form Inputs (Admin Panel & Contact Form)
- Class: `flex h-11 w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition duration-150`

### 4.4 Badges & Pills
- Class: `inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200/60`

### 4.5 Floating Action Button (FAB WhatsApp)
- Class: `fixed bottom-6 right-6 z-50 flex items-center gap-2 px-4 py-3 bg-[#25D366] hover:bg-[#20ba59] text-white font-medium text-sm rounded-full shadow-lg shadow-green-500/30 hover:scale-105 transition-all duration-200 group`
- Tambahkan pulse ring effect halus (`animate-ping opacity-75`) untuk menarik atensi tanpa mengganggu pandangan.

---

## 5. Spacing & Container Layout

- **Max Width Container**: `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8`
- **Section Padding**: `py-16 md:py-24`
- **Grid Gaps**: `gap-6 md:gap-8`
- **Border Radius**:
  - Small elements (badges, buttons, inputs): `rounded-xl` (`12px`)
  - Medium elements (cards, modals, dropdowns): `rounded-2xl` (`16px`)
  - Full rounded (pills, avatar, FAB): `rounded-full`

---

## 6. Icons & Imagery

- **Icon Set**: `lucide-vue-next` (Lucide Icons).
- **Style**: Stroke width 1.75px atau 2px, warna selaras (`text-orange-500` untuk aksen atau `text-slate-700` untuk netral).
- **Showcase Visuals**: Gambar mockup perangkat (laptop, smartphone Android, VR Headset, AR 3D interactive preview) berlatar belakang transparan atau card gradient lembut.
