<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { MessageCircle, Sparkles, Check, CheckCircle2, Image as ImageIcon, Upload, Trash2, Globe, Monitor } from '@lucide/vue';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({}),
    },
});

const logoPreview = ref(props.settings.site_logo || null);
const faviconPreview = ref(props.settings.site_favicon || null);

const form = useForm({
    site_name: props.settings.site_name || 'Virtarastudio',
    site_tagline: props.settings.site_tagline || '',
    whatsapp_number: props.settings.whatsapp_number || '6281234567890',
    email: props.settings.email || '',
    address: props.settings.address || 'Indonesia',
    hero_badge: props.settings.hero_badge || '',
    hero_title: props.settings.hero_title || 'Harmoni Karya Seni & Kecanggihan',
    hero_title_highlight: props.settings.hero_title_highlight || 'Teknologi Digital',
    hero_subtitle: props.settings.hero_subtitle || '',
    instagram_url: props.settings.instagram_url || '',
    tiktok_url: props.settings.tiktok_url || '',
    linkedin_url: props.settings.linkedin_url || '',
    site_logo: null,
    site_favicon: null,
    remove_site_logo: false,
    remove_site_favicon: false,
});

const handleLogoChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.site_logo = file;
        form.remove_site_logo = false;
        logoPreview.value = URL.createObjectURL(file);
    }
};

const removeLogo = () => {
    form.site_logo = null;
    form.remove_site_logo = true;
    logoPreview.value = null;
};

const handleFaviconChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.site_favicon = file;
        form.remove_site_favicon = false;
        faviconPreview.value = URL.createObjectURL(file);
    }
};

const removeFavicon = () => {
    form.site_favicon = null;
    form.remove_site_favicon = true;
    faviconPreview.value = null;
};

const submit = () => {
    form.post(route('admin.settings.update'), {
        preserveScroll: true,
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Pengaturan Landing Page & Logo - Virtarastudio" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        Pengaturan Landing Page & Logo
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Kelola logo halaman depan, icon title bar (favicon), nomor WhatsApp, dan konten website.
                    </p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <!-- Success Message Banner -->
                <div
                    v-if="$page.props.flash?.success"
                    class="mb-6 flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800 shadow-sm"
                >
                    <CheckCircle2 class="h-5 w-5 text-green-600 shrink-0" />
                    <span>{{ $page.props.flash.success }}</span>
                </div>

                <form @submit.prevent="submit" class="space-y-8">
                    <!-- Section: Logo & Favicon Management -->
                    <Card class="border-slate-200 shadow-xs">
                        <CardHeader class="border-b border-slate-100 bg-slate-50/50">
                            <CardTitle class="text-lg flex items-center gap-2 text-slate-900">
                                <ImageIcon class="h-5 w-5 text-blue-600" />
                                Logo Website & Icon Title Bar (Favicon)
                            </CardTitle>
                            <CardDescription>
                                Unggah logo resmi untuk navigasi halaman depan (Navbar & Footer) serta icon kecil pada tab browser (Title Bar).
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="p-6 space-y-8">
                            <!-- 1. Logo Halaman Depan -->
                            <div class="space-y-4">
                                <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                                    1. Logo Utama Halaman Depan (Header Navbar & Footer)
                                </label>

                                <div class="grid gap-6 md:grid-cols-2 items-start">
                                    <!-- Upload Input Box -->
                                    <div class="space-y-3">
                                        <div class="flex items-center gap-3">
                                            <label
                                                class="flex-1 flex flex-col items-center justify-center border-2 border-dashed border-slate-300 rounded-2xl p-4 cursor-pointer hover:border-blue-500 hover:bg-blue-50/30 transition-all text-center group"
                                            >
                                                <Upload class="h-6 w-6 text-slate-400 group-hover:text-blue-600 mb-2 transition-colors" />
                                                <span class="text-xs font-semibold text-slate-700 group-hover:text-blue-600">
                                                    {{ logoPreview ? 'Ganti Logo' : 'Pilih File Logo' }}
                                                </span>
                                                <span class="text-[11px] text-slate-400 mt-1">PNG, JPG, WebP, SVG (Maks. 2MB)</span>
                                                <input
                                                    type="file"
                                                    accept="image/png, image/jpeg, image/webp, image/svg+xml"
                                                    class="hidden"
                                                    @change="handleLogoChange"
                                                />
                                            </label>

                                            <Button
                                                v-if="logoPreview"
                                                type="button"
                                                variant="outline"
                                                size="icon"
                                                class="h-12 w-12 rounded-xl text-red-500 border-red-200 hover:bg-red-50 hover:text-red-700 shrink-0"
                                                title="Hapus Logo"
                                                @click="removeLogo"
                                            >
                                                <Trash2 class="h-5 w-5" />
                                            </Button>
                                        </div>
                                        <span v-if="form.errors.site_logo" class="text-xs text-red-500 block">
                                            {{ form.errors.site_logo }}
                                        </span>
                                    </div>

                                    <!-- Live Preview Cards (Light Navbar & Dark Footer) -->
                                    <div class="space-y-3">
                                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">
                                            Preview Tampilan Halaman Depan:
                                        </span>

                                        <!-- Preview on Light Background (Navbar) -->
                                        <div class="rounded-xl border border-slate-200 bg-white p-3 shadow-xs">
                                            <span class="text-[10px] text-slate-400 font-semibold block mb-1.5">Background Terang (Navbar):</span>
                                            <div class="h-12 flex items-center px-3 border border-slate-100 rounded-lg bg-white">
                                                <template v-if="logoPreview">
                                                    <img :src="logoPreview" alt="Logo Preview" class="h-8 max-w-[160px] object-contain" />
                                                </template>
                                                <template v-else>
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-600 text-white">
                                                            <Sparkles class="h-4 w-4" />
                                                        </div>
                                                        <span class="font-extrabold text-sm text-slate-900">
                                                            {{ form.site_name.substring(0, Math.ceil(form.site_name.length / 2)) }}<span class="text-amber-500">{{ form.site_name.substring(Math.ceil(form.site_name.length / 2)) }}</span>
                                                        </span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- Preview on Dark Background (Footer) -->
                                        <div class="rounded-xl border border-slate-800 bg-slate-900 p-3 shadow-xs">
                                            <span class="text-[10px] text-slate-400 font-semibold block mb-1.5">Background Gelap (Footer):</span>
                                            <div class="h-12 flex items-center px-3 rounded-lg bg-slate-800/80 border border-slate-700/50">
                                                <template v-if="logoPreview">
                                                    <img :src="logoPreview" alt="Logo Preview Dark" class="h-8 max-w-[160px] object-contain" />
                                                </template>
                                                <template v-else>
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-600 text-white">
                                                            <Sparkles class="h-4 w-4" />
                                                        </div>
                                                        <span class="font-extrabold text-sm text-white">
                                                            {{ form.site_name.substring(0, Math.ceil(form.site_name.length / 2)) }}<span class="text-amber-400">{{ form.site_name.substring(Math.ceil(form.site_name.length / 2)) }}</span>
                                                        </span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="border-slate-100" />

                            <!-- 2. Favicon Title Bar -->
                            <div class="space-y-4">
                                <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                                    2. Icon Title Bar Browser (Favicon / Tab Web)
                                </label>

                                <div class="grid gap-6 md:grid-cols-2 items-start">
                                    <!-- Upload Input Box -->
                                    <div class="space-y-3">
                                        <div class="flex items-center gap-3">
                                            <label
                                                class="flex-1 flex flex-col items-center justify-center border-2 border-dashed border-slate-300 rounded-2xl p-4 cursor-pointer hover:border-amber-500 hover:bg-amber-50/30 transition-all text-center group"
                                            >
                                                <Globe class="h-6 w-6 text-slate-400 group-hover:text-amber-600 mb-2 transition-colors" />
                                                <span class="text-xs font-semibold text-slate-700 group-hover:text-amber-600">
                                                    {{ faviconPreview ? 'Ganti Favicon' : 'Pilih File Favicon' }}
                                                </span>
                                                <span class="text-[11px] text-slate-400 mt-1">PNG, ICO, SVG (Persegi 1:1, Maks. 1MB)</span>
                                                <input
                                                    type="file"
                                                    accept="image/png, image/x-icon, image/vnd.microsoft.icon, image/svg+xml, image/webp"
                                                    class="hidden"
                                                    @change="handleFaviconChange"
                                                />
                                            </label>

                                            <Button
                                                v-if="faviconPreview"
                                                type="button"
                                                variant="outline"
                                                size="icon"
                                                class="h-12 w-12 rounded-xl text-red-500 border-red-200 hover:bg-red-50 hover:text-red-700 shrink-0"
                                                title="Hapus Favicon"
                                                @click="removeFavicon"
                                            >
                                                <Trash2 class="h-5 w-5" />
                                            </Button>
                                        </div>
                                        <span v-if="form.errors.site_favicon" class="text-xs text-red-500 block">
                                            {{ form.errors.site_favicon }}
                                        </span>
                                    </div>

                                    <!-- Browser Tab Mockup Preview -->
                                    <div class="space-y-2">
                                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">
                                            Preview Title Bar Tab Browser:
                                        </span>

                                        <div class="rounded-xl border border-slate-200 bg-slate-100 p-2 shadow-xs">
                                            <!-- Tab Head Mockup -->
                                            <div class="flex items-center gap-2 bg-slate-200/80 rounded-t-lg px-2 pt-2 pb-1">
                                                <div class="flex items-center gap-1.5 px-3 py-1.5 bg-white rounded-t-md border-t border-x border-slate-300 max-w-[240px] shadow-xs">
                                                    <img
                                                        v-if="faviconPreview"
                                                        :src="faviconPreview"
                                                        alt="Favicon Preview"
                                                        class="h-4 w-4 rounded-xs object-contain shrink-0"
                                                    />
                                                    <div v-else class="h-4 w-4 rounded-xs bg-blue-600 text-white flex items-center justify-center shrink-0 text-[9px] font-bold">
                                                        V
                                                    </div>
                                                    <span class="text-xs font-medium text-slate-700 truncate">
                                                        {{ form.site_name || 'Virtarastudio' }} - Jasa Web...
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- Address Bar Mockup -->
                                            <div class="bg-white border-t border-slate-200 p-2 rounded-b-lg flex items-center gap-2 text-[11px] text-slate-500">
                                                <Monitor class="h-3.5 w-3.5 text-slate-400 shrink-0" />
                                                <span class="truncate">https://{{ (form.site_name || 'virtarastudio').toLowerCase().replace(/\s+/g, '') }}.com</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Section 1: WhatsApp & Kontak Utama -->
                    <Card class="border-slate-200 shadow-xs">
                        <CardHeader>
                            <CardTitle class="text-lg flex items-center gap-2">
                                <MessageCircle class="h-5 w-5 text-[#25D366]" />
                                Kontak Utama & Nomor WhatsApp Konsultasi
                            </CardTitle>
                            <CardDescription>
                                Seluruh tombol "Konsultasi Gratis" di website akan mengarah ke nomor WhatsApp ini.
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Nomor WhatsApp (Gunakan kode negara, misal: 6281234567890) *
                                </label>
                                <Input
                                    v-model="form.whatsapp_number"
                                    type="text"
                                    placeholder="628xxxxxxxxxx"
                                    required
                                />
                                <span v-if="form.errors.whatsapp_number" class="text-xs text-red-500 mt-1 block">
                                    {{ form.errors.whatsapp_number }}
                                </span>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Email Kontak Resmi
                                    </label>
                                    <Input
                                        v-model="form.email"
                                        type="email"
                                        placeholder="kontak@virtarastudio.com"
                                    />
                                    <span v-if="form.errors.email" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.email }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Lokasi / Alamat Singkat
                                    </label>
                                    <Input
                                        v-model="form.address"
                                        type="text"
                                        placeholder="Indonesia"
                                    />
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Section 2: Hero Section Landing Page -->
                    <Card class="border-slate-200 shadow-xs">
                        <CardHeader>
                            <CardTitle class="text-lg flex items-center gap-2">
                                <Sparkles class="h-5 w-5 text-orange-500" />
                                Teks Hero Section (Bagian Paling Atas)
                            </CardTitle>
                            <CardDescription>
                                Headline dan kalimat pembuka yang pertama kali dilihat oleh pengunjung website.
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Teks Badge Kecil (Pill)
                                </label>
                                <Input
                                    v-model="form.hero_badge"
                                    type="text"
                                    placeholder="✨ Solusi Digital Kreatif & Terjangkau"
                                />
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Judul Utama Besar (Teks Biasa) *
                                </label>
                                <Input
                                    v-model="form.hero_title"
                                    type="text"
                                    placeholder="Harmoni Karya Seni & Kecanggihan"
                                    required
                                />
                                <span v-if="form.errors.hero_title" class="text-xs text-red-500 mt-1 block">
                                    {{ form.errors.hero_title }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Judul Utama Besar (Teks Sorotan Biru Teknologi)
                                </label>
                                <Input
                                    v-model="form.hero_title_highlight"
                                    type="text"
                                    placeholder="Teknologi Digital"
                                />
                                <span class="text-[11px] text-slate-400 mt-1 block">
                                    Teks ini akan tampil berdampingan dengan judul utama dan diberi warna Biru Teknologi solid.
                                </span>
                            </div>

                            <!-- Live Preview Box -->
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                                    Preview Teks Besar di Beranda:
                                </span>
                                <div class="text-lg sm:text-xl font-extrabold text-slate-900 leading-snug">
                                    {{ form.hero_title }}
                                    <span v-if="form.hero_title_highlight" class="text-blue-600 ml-1.5">
                                        {{ form.hero_title_highlight }}
                                    </span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Subheadline (Deskripsi Lengkap Hero) *
                                </label>
                                <Textarea
                                    v-model="form.hero_subtitle"
                                    rows="3"
                                    placeholder="Tuliskan deskripsi ringkas yang menarik..."
                                    required
                                />
                                <span v-if="form.errors.hero_subtitle" class="text-xs text-red-500 mt-1 block">
                                    {{ form.errors.hero_subtitle }}
                                </span>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Section 3: Brand & Sosial Media -->
                    <Card class="border-slate-200 shadow-xs">
                        <CardHeader>
                            <CardTitle class="text-lg">
                                Identitas Brand & Media Sosial
                            </CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Nama Studio / Website *
                                    </label>
                                    <Input
                                        v-model="form.site_name"
                                        type="text"
                                        placeholder="Virtarastudio"
                                        required
                                    />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Tagline Studio
                                    </label>
                                    <Input
                                        v-model="form.site_tagline"
                                        type="text"
                                        placeholder="Studio Solusi Digital, Game & Immersive Tech Terjangkau"
                                    />
                                </div>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-3 pt-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Link Instagram
                                    </label>
                                    <Input
                                        v-model="form.instagram_url"
                                        type="url"
                                        placeholder="https://instagram.com/..."
                                    />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Link TikTok
                                    </label>
                                    <Input
                                        v-model="form.tiktok_url"
                                        type="url"
                                        placeholder="https://tiktok.com/@..."
                                    />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Link LinkedIn
                                    </label>
                                    <Input
                                        v-model="form.linkedin_url"
                                        type="url"
                                        placeholder="https://linkedin.com/..."
                                    />
                                </div>
                            </div>
                        </CardContent>
                        <CardFooter class="flex justify-end border-t border-slate-100 p-6">
                            <Button
                                type="submit"
                                :disabled="form.processing"
                                variant="default"
                                size="lg"
                                class="gap-2 font-bold min-w-[180px] bg-blue-600 hover:bg-blue-700 text-white shadow-sm"
                            >
                                <Check class="h-4 w-4" />
                                {{ form.processing ? 'Menyimpan...' : 'Simpan Pengaturan' }}
                            </Button>
                        </CardFooter>
                    </Card>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
