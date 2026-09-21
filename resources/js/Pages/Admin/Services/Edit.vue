<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { ArrowLeft, Check, Sparkles } from '@lucide/vue';

const props = defineProps({
    service: {
        type: Object,
        required: true,
    },
});

const featuresText = Array.isArray(props.service.features)
    ? props.service.features.join('\n')
    : '';

const form = useForm({
    name: props.service.name,
    tagline: props.service.tagline || '',
    description: props.service.description,
    icon_name: props.service.icon_name || 'Globe',
    starting_price: props.service.starting_price,
    features_input: featuresText,
    whatsapp_template: props.service.whatsapp_template || '',
    is_active: Boolean(props.service.is_active),
    sort_order: props.service.sort_order || 0,
});

const submit = () => {
    const featuresArray = form.features_input
        .split('\n')
        .map((f) => f.trim())
        .filter((f) => f.length > 0);

    form.transform((data) => ({
        name: data.name,
        tagline: data.tagline,
        description: data.description,
        icon_name: data.icon_name,
        starting_price: data.starting_price,
        features: featuresArray,
        whatsapp_template: data.whatsapp_template,
        is_active: data.is_active,
        sort_order: Number(data.sort_order),
    })).put(route('admin.services.update', props.service.id));
};
</script>

<template>
    <Head :title="`Edit Layanan: ${service.name} - Virtarastudio`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link
                    :href="route('admin.services.index')"
                    class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition"
                >
                    <ArrowLeft class="h-4 w-4" />
                </Link>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        Edit Layanan: {{ service.name }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-0.5">
                        Sesuaikan detail harga, teks fitur, dan pesan WhatsApp.
                    </p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <Card class="border-slate-200">
                    <form @submit.prevent="submit">
                        <CardContent class="space-y-5 p-6 sm:p-8">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Nama Layanan *
                                    </label>
                                    <Input v-model="form.name" required />
                                    <span v-if="form.errors.name" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.name }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Tagline / Slogan Singkat
                                    </label>
                                    <Input v-model="form.tagline" />
                                </div>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Harga Mulai Dari (Contoh: Rp 499.000) *
                                    </label>
                                    <Input v-model="form.starting_price" required />
                                    <span v-if="form.errors.starting_price" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.starting_price }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Ikon Layanan (Globe, Smartphone, Gamepad2, Scan, Glasses) *
                                    </label>
                                    <Input v-model="form.icon_name" required />
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Deskripsi Layanan *
                                </label>
                                <Textarea v-model="form.description" rows="3" required />
                                <span v-if="form.errors.description" class="text-xs text-red-500 mt-1 block">
                                    {{ form.errors.description }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Daftar Poin Fitur (Pisahkan setiap poin dengan baris baru / Enter)
                                </label>
                                <Textarea
                                    v-model="form.features_input"
                                    rows="5"
                                    placeholder="Contoh:&#10;Gratis Domain & Hosting Setup&#10;Desain Responsif&#10;SEO Friendly"
                                />
                                <span class="text-[11px] text-slate-400 mt-1 block">
                                    Setiap baris teks akan otomatis menjadi poin checklist bertanda centang di landing page.
                                </span>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Template Pesan WhatsApp Otomatis
                                </label>
                                <Textarea
                                    v-model="form.whatsapp_template"
                                    rows="3"
                                    placeholder="Halo Virtarastudio, saya tertarik dengan layanan ini..."
                                />
                                <span class="text-[11px] text-slate-400 mt-1 block">
                                    Pesan ini akan langsung muncul di chat WhatsApp pengunjung saat mereka menekan tombol "Konsultasi Layanan Ini".
                                </span>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2 pt-2 border-t border-slate-100">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Urutan Tampilan
                                    </label>
                                    <Input v-model="form.sort_order" type="number" min="0" />
                                </div>

                                <div class="flex items-center pt-6">
                                    <label class="inline-flex items-center gap-2 cursor-pointer">
                                        <input
                                            v-model="form.is_active"
                                            type="checkbox"
                                            class="h-4 w-4 rounded border-slate-300 text-orange-600 focus:ring-orange-500"
                                        />
                                        <span class="text-sm font-medium text-slate-700">Tampilkan Layanan Ini di Landing Page</span>
                                    </label>
                                </div>
                            </div>
                        </CardContent>

                        <CardFooter class="flex items-center justify-between border-t border-slate-100 p-6">
                            <Link
                                :href="route('admin.services.index')"
                                class="text-xs font-semibold text-slate-500 hover:text-slate-800"
                            >
                                Batal
                            </Link>

                            <Button
                                type="submit"
                                :disabled="form.processing"
                                variant="default"
                                size="lg"
                                class="gap-2 font-bold min-w-[140px]"
                            >
                                <Check class="h-4 w-4" />
                                {{ form.processing ? 'Menyimpan...' : 'Perbarui Layanan' }}
                            </Button>
                        </CardFooter>
                    </form>
                </Card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
