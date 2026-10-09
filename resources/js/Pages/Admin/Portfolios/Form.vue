<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { ArrowLeft, Check, Upload, Image as ImageIcon, Trash2, Link as LinkIcon } from '@lucide/vue';

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

const imagePreview = ref(props.portfolio?.image_url || null);
const fileInput = ref(null);

const form = useForm({
    service_id: props.portfolio?.service_id || '',
    category: props.portfolio?.category || 'website',
    title: props.portfolio?.title || '',
    client_name: props.portfolio?.client_name || '',
    description: props.portfolio?.description || '',
    image: null,
    image_url: props.portfolio?.image_url || '',
    remove_image: false,
    demo_url: props.portfolio?.demo_url || '',
    technologies_input: initialTechs,
    technologies: [],
    is_featured: props.portfolio ? Boolean(props.portfolio.is_featured) : false,
    sort_order: props.portfolio?.sort_order || 0,
});

const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.image = file;
        form.remove_image = false;
        imagePreview.value = URL.createObjectURL(file);
    }
};

const triggerFileInput = () => {
    fileInput.value?.click();
};

const removeImage = () => {
    form.image = null;
    form.image_url = '';
    form.remove_image = true;
    imagePreview.value = null;
    if (fileInput.value) {
        fileInput.value.value = '';
    }
};

const handleUrlChange = () => {
    if (form.image_url && !form.image) {
        imagePreview.value = form.image_url;
        form.remove_image = false;
    }
};

const submit = () => {
    const techArray = form.technologies_input
        ? form.technologies_input
              .split(',')
              .map((t) => t.trim())
              .filter((t) => t.length > 0)
        : [];

    form.technologies = techArray;

    if (isEdit) {
        form.post(route('admin.portfolios.update', props.portfolio.id), {
            preserveScroll: true,
            forceFormData: true,
        });
    } else {
        form.post(route('admin.portfolios.store'), {
            preserveScroll: true,
            forceFormData: true,
        });
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
                        Lengkapi foto dan detail hasil karya untuk ditampilkan pada showcase website.
                    </p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <Card class="border-slate-200">
                    <form @submit.prevent="submit">
                        <CardContent class="space-y-6 p-6 sm:p-8">
                            <!-- Judul & Kategori -->
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
                                    <span v-if="form.errors.category" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Klien & Relasi Layanan -->
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Nama Klien / Brand (Opsional)
                                    </label>
                                    <Input v-model="form.client_name" placeholder="Contoh: PT ABC / Toko Kopi" />
                                    <span v-if="form.errors.client_name" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.client_name }}
                                    </span>
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
                                    <span v-if="form.errors.service_id" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.service_id }}
                                    </span>
                                </div>
                            </div>

                            <!-- Upload Foto / Gambar Showcase -->
                            <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-5 space-y-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-900 uppercase tracking-wide">
                                        Foto / Gambar Portofolio
                                    </label>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        Upload file gambar hasil karya proyek (Format: PNG, JPG, JPEG, WebP, SVG. Maks 3MB).
                                    </p>
                                </div>

                                <div class="grid gap-5 sm:grid-cols-12 items-start">
                                    <!-- Image Preview Area -->
                                    <div class="sm:col-span-5">
                                        <div
                                            class="relative aspect-video w-full rounded-xl border-2 border-dashed border-slate-200 bg-white overflow-hidden flex flex-col items-center justify-center group shadow-2xs"
                                        >
                                            <template v-if="imagePreview">
                                                <img
                                                    :src="imagePreview"
                                                    alt="Preview Portofolio"
                                                    class="h-full w-full object-cover"
                                                />
                                                <div
                                                    class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2"
                                                >
                                                    <button
                                                        type="button"
                                                        @click="triggerFileInput"
                                                        class="rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition"
                                                    >
                                                        Ganti
                                                    </button>
                                                    <button
                                                        type="button"
                                                        @click="removeImage"
                                                        class="rounded-lg bg-red-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-red-700 transition"
                                                    >
                                                        Hapus
                                                    </button>
                                                </div>
                                            </template>
                                            <template v-else>
                                                <div class="flex flex-col items-center justify-center p-4 text-center cursor-pointer" @click="triggerFileInput">
                                                    <div class="h-10 w-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-600 mb-2">
                                                        <ImageIcon class="h-5 w-5" />
                                                    </div>
                                                    <span class="text-xs font-medium text-slate-600">Belum ada gambar</span>
                                                    <span class="text-[11px] text-slate-400 mt-0.5">Klik untuk upload</span>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Upload Controls & URL fallback -->
                                    <div class="sm:col-span-7 space-y-3">
                                        <input
                                            ref="fileInput"
                                            type="file"
                                            accept="image/png,image/jpeg,image/jpg,image/webp,image/svg+xml"
                                            class="hidden"
                                            @change="handleImageChange"
                                        />

                                        <div class="flex flex-wrap gap-2">
                                            <Button
                                                type="button"
                                                variant="outline"
                                                size="sm"
                                                class="gap-2 text-xs font-semibold border-slate-300"
                                                @click="triggerFileInput"
                                            >
                                                <Upload class="h-3.5 w-3.5 text-orange-600" />
                                                {{ imagePreview ? 'Pilih Gambar Baru' : 'Upload File Gambar' }}
                                            </Button>

                                            <Button
                                                v-if="imagePreview"
                                                type="button"
                                                variant="outline"
                                                size="sm"
                                                class="gap-2 text-xs font-semibold border-red-200 text-red-600 hover:bg-red-50"
                                                @click="removeImage"
                                            >
                                                <Trash2 class="h-3.5 w-3.5" />
                                                Hapus Gambar
                                            </Button>
                                        </div>

                                        <div class="pt-2 border-t border-slate-200/80">
                                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">
                                                Atau gunakan URL Gambar Eksternal:
                                            </label>
                                            <div class="relative">
                                                <Input
                                                    v-model="form.image_url"
                                                    placeholder="https://images.unsplash.com/..."
                                                    class="text-xs h-9 pl-8"
                                                    @input="handleUrlChange"
                                                />
                                                <LinkIcon class="h-3.5 w-3.5 text-slate-400 absolute left-2.5 top-3" />
                                            </div>
                                        </div>

                                        <span v-if="form.errors.image" class="text-xs text-red-500 block">
                                            {{ form.errors.image }}
                                        </span>
                                        <span v-if="form.errors.image_url" class="text-xs text-red-500 block">
                                            {{ form.errors.image_url }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi Singkat -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Deskripsi Singkat Proyek
                                </label>
                                <Textarea v-model="form.description" rows="3" placeholder="Jelaskan fitur atau hasil karya..." />
                                <span v-if="form.errors.description" class="text-xs text-red-500 mt-1 block">
                                    {{ form.errors.description }}
                                </span>
                            </div>

                            <!-- Demo URL & Teknologi -->
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Tautan Demo / Live Preview (Opsional)
                                    </label>
                                    <Input v-model="form.demo_url" placeholder="https://..." />
                                    <span v-if="form.errors.demo_url" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.demo_url }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Teknologi (Pisahkan dengan koma)
                                    </label>
                                    <Input
                                        v-model="form.technologies_input"
                                        placeholder="Contoh: Laravel, Vue.js, Unity, WebXR"
                                    />
                                    <span v-if="form.errors.technologies" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.technologies }}
                                    </span>
                                </div>
                            </div>

                            <!-- Urutan & Featured -->
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
