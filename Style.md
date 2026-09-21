# Design System & Style Guidelines (Style.md)
**Project Name**: Virtarastudio  
**Core Theme**: *Flat Modern White* — Solid Kuning (Seni) & Solid Biru (Teknologi) (*Tanpa Gradasi*)  
**UI Library**: shadcn-vue + Tailwind CSS + Lucide Icons  

---

## 1. Filosofi Desain: "Solid Flat Modern — Seni & Teknologi"

Virtarastudio mengusung estetika **flat modern, bersih, minimalis, dan berani** tanpa menggunakan efek gradasi (*no gradients*). Desain berfokus pada kekuatan warna solid, ruang putih yang lega (*whitespace*), batas (*border*) yang tegas namun halus, serta kontras tipografi yang kuat.

Dua pilar warna utama:
- **Kuning / Solid Amber (`#F59E0B`) = SENI**:
  - Melambangkan kreativitas visual, desain estetis, interaksi ramah, aset seni game 2D/3D.
  - Warna solid tanpa gradasi untuk tombol aksi primer, ikon seni, dan highlight seni.
- **Biru Teknologi (`#2563EB`) = TEKNOLOGI**:
  - Melambangkan rekayasa software, keandalan server Laravel, stabilitas aplikasi Android, serta kecanggihan AR & VR.
  - Warna solid tanpa gradasi untuk elemen teknologi, tombol sekunder, border highlight, dan tag teknologi.
- **Putih Bersih (CRISP WHITE CANVAS)**:
  - Latar belakang murni putih (`#FFFFFF`) dipadu dengan kontras bersih abu-abu lembut (`#F8FAFC`) untuk section berselang.

---

## 2. Palet Warna Solid (Flat Color Palette)

### 2.1 Pilar Seni: Solid Kuning / Amber
| Token | HEX Code | Tailwind Class | Penggunaan |
| :--- | :--- | :--- | :--- |
| **Amber Solid** | `#F59E0B` | `bg-amber-500`, `text-amber-500` | **Warna Tombol Aksi Utama**, ikon seni, aksen logo |
| **Amber Hover** | `#D97706` | `hover:bg-amber-600` | State hover tombol seni |
| **Amber Soft** | `#FFFBEB` | `bg-amber-50`, `border-amber-200` | Tag / badge pilar seni, kontainer fitur seni |
| **Amber Text** | `#B45309` | `text-amber-700` | Teks label pada badge seni |

### 2.2 Pilar Teknologi: Solid Biru
| Token | HEX Code | Tailwind Class | Penggunaan |
| :--- | :--- | :--- | :--- |
| **Blue Solid** | `#2563EB` | `bg-blue-600`, `text-blue-600` | **Warna Tombol Teknologi**, ikon teknologi, border sorotan |
| **Blue Hover** | `#1D4ED8` | `hover:bg-blue-700` | State hover elemen teknologi |
| **Blue Soft** | `#EFF6FF` | `bg-blue-50`, `border-blue-200` | Tag / badge pilar teknologi, kontainer fitur teknis |
| **Blue Text** | `#1E40AF` | `text-blue-800` | Teks label pada badge teknologi |

### 2.3 Netral & Kanvas Solid
| Token | HEX Code | Tailwind Class | Penggunaan |
| :--- | :--- | :--- | :--- |
| **Pure White** | `#FFFFFF` | `bg-white` | Latar belakang utama seluruh halaman |
| **Surface Off-White** | `#F8FAFC` | `bg-slate-50` | Latar selang-seling section (tanpa gradasi) |
| **Border Solid** | `#E2E8F0` | `border-slate-200` | Garis batas kartu, navbar, form input |
| **Dark Solid** | `#0F172A` | `bg-slate-900`, `text-slate-900` | Banner solid, teks judul utama, footer |

### 2.4 WhatsApp Solid
| Token | HEX Code | Tailwind Class | Penggunaan |
| :--- | :--- | :--- | :--- |
| **WhatsApp Green** | `#25D366` | `bg-[#25D366]` | Floating WhatsApp Button & tombol chat WA |
| **WhatsApp Hover** | `#20BA59` | `hover:bg-[#20ba59]` | State hover tombol WhatsApp |

---

## 3. Ketentuan Desain (Strict Rules)

- **TIDAK ADA GRADASI (NO GRADIENTS)**: Dilarang menggunakan kelas `bg-gradient-*`, `from-*`, `via-*`, `to-*`, ataupun `bg-clip-text text-transparent`. Seluruh warna harus solid, tegas, dan kontras.
- **TIDAK ADA AMBIENT BLUR ORBS**: Tidak menggunakan background blur berbentuk gradasi. Ruang putih (*whitespace*) dijaga bersih dan rapi.
- **Batas & Sudut Halus**: Menggunakan `border border-slate-200` yang rapi dengan sudut membulat modern (`rounded-2xl` untuk kartu, `rounded-xl` untuk tombol/input).
- **Akses Admin Tersembunyi**: Tidak ada tombol atau teks "Admin Login" di navbar maupun footer publik. Admin login hanya dapat diakses langsung melalui link rahasia `/login`.
