<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { MessageCircle, Sparkles, Check, CheckCircle2 } from '@lucide/vue';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({}),
    },
});

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
});

const submit = () => {
    form.put(route('admin.settings.update'));
};
</script>

<template>
    <Head title="Pengaturan Landing Page - Virtarastudio" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        Pengaturan Landing Page
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Perbarui kontak WhatsApp utama, teks hero, dan informasi bisnis Anda.
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
                    <!-- Section 1: WhatsApp & Kontak Utama -->
                    <Card class="border-slate-200">
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
                    <Card class="border-slate-200">
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
                    <Card class="border-slate-200">
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
                                class="gap-2 font-bold min-w-[160px]"
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
