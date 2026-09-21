<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { ArrowLeft, Check } from '@lucide/vue';

const props = defineProps({
    portfolio: {
        type: Object,
        default: null,
    },
    services: {
        type: Array,
        default: () => [],
    },
});

const isEdit = Boolean(props.portfolio);

const initialTechs = props.portfolio?.technologies
    ? Array.isArray(props.portfolio.technologies)
        ? props.portfolio.technologies.join(', ')
        : props.portfolio.technologies
    : '';

const form = useForm({
    service_id: props.portfolio?.service_id || '',
    category: props.portfolio?.category || 'website',
    title: props.portfolio?.title || '',
    client_name: props.portfolio?.client_name || '',
    description: props.portfolio?.description || '',
    image_url: props.portfolio?.image_url || '',
    demo_url: props.portfolio?.demo_url || '',
    technologies_input: initialTechs,
    is_featured: props.portfolio ? Boolean(props.portfolio.is_featured) : false,
    sort_order: props.portfolio?.sort_order || 0,
});

const submit = () => {
    const techArray = form.technologies_input
        ? form.technologies_input
              .split(',')
              .map((t) => t.trim())
              .filter((t) => t.length > 0)
        : [];

    const payload = {
        service_id: form.service_id || null,
        category: form.category,
        title: form.title,
        client_name: form.client_name,
        description: form.description,
        image_url: form.image_url,
        demo_url: form.demo_url,
        technologies: techArray,
        is_featured: form.is_featured,
        sort_order: Number(form.sort_order),
    };

    if (isEdit) {
        form.transform(() => payload).put(route('admin.portfolios.update', props.portfolio.id));
    } else {
        form.transform(() => payload).post(route('admin.portfolios.store'));
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} Portofolio - Virtarastudio`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link
                    :href="route('admin.portfolios.index')"
                    class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition"
                >
                    <ArrowLeft class="h-4 w-4" />
                </Link>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        {{ isEdit ? 'Edit Portofolio' : 'Tambah Portofolio Baru' }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-0.5">
                        Lengkapi detail hasil karya untuk ditampilkan pada showcase website.
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
                                        Judul Portofolio *
                                    </label>
                                    <Input v-model="form.title" placeholder="Nama proyek..." required />
                                    <span v-if="form.errors.title" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.title }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Kategori Jasa *
                                    </label>
                                    <select
                                        v-model="form.category"
                                        class="flex h-11 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"
                                        required
                                    >
                                        <option value="website">Website</option>
                                        <option value="android">Android App</option>
                                        <option value="game">Game Android</option>
                                        <option value="ar">AR (Augmented Reality)</option>
                                        <option value="vr">VR (Virtual Reality)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Nama Klien / Brand (Opsional)
                                    </label>
                                    <Input v-model="form.client_name" placeholder="Contoh: PT ABC / Toko Kopi" />
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Hubungkan ke Layanan (Opsional)
                                    </label>
                                    <select
                                        v-model="form.service_id"
                                        class="flex h-11 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"
                                    >
                                        <option value="">-- Tanpa Relasi Layanan --</option>
                                        <option v-for="srv in services" :key="srv.id" :value="srv.id">
                                            {{ srv.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Deskripsi Singkat Proyek
                                </label>
                                <Textarea v-model="form.description" rows="3" placeholder="Jelaskan fitur atau hasil karya..." />
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        URL Gambar Thumbnail Showcase
                                    </label>
                                    <Input v-model="form.image_url" placeholder="https://images.unsplash.com/..." />
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Tautan Demo / Live Preview
                                    </label>
                                    <Input v-model="form.demo_url" placeholder="https://..." />
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Teknologi yang Digunakan (Pisahkan dengan tanda koma)
                                </label>
                                <Input
                                    v-model="form.technologies_input"
                                    placeholder="Contoh: Laravel, Vue.js, Unity, WebXR"
                                />
                            </div>

                            <div class="flex items-center gap-6 pt-2 border-t border-slate-100">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Urutan
                                    </label>
                                    <Input v-model="form.sort_order" type="number" min="0" class="w-24" />
                                </div>

                                <div class="pt-5">
                                    <label class="inline-flex items-center gap-2 cursor-pointer">
                                        <input
                                            v-model="form.is_featured"
                                            type="checkbox"
                                            class="h-4 w-4 rounded border-slate-300 text-orange-600 focus:ring-orange-500"
                                        />
                                        <span class="text-sm font-medium text-slate-700">Tandai sebagai Featured</span>
                                    </label>
                                </div>
                            </div>
                        </CardContent>

                        <CardFooter class="flex items-center justify-between border-t border-slate-100 p-6">
                            <Link
                                :href="route('admin.portfolios.index')"
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
                                {{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan' : 'Tambah Portofolio') }}
                            </Button>
                        </CardFooter>
                    </form>
                </Card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
