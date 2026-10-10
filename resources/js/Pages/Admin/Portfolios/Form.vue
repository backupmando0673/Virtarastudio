<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { Badge } from '@/Components/ui/badge';
import {
    ArrowLeft,
    Check,
    Upload,
    Image as ImageIcon,
    Trash2,
    Star,
    Plus,
    Link as LinkIcon,
    Layers,
    CheckCircle2,
} from '@lucide/vue';

const props = defineProps({
    portfolio: {
        type: Object,
        default: null,
    },
    services: {
        type: Array,
        default: () => [],
    },
    categories: {
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

// Prepare initial gallery list
const initialGallery = Array.isArray(props.portfolio?.gallery_images)
    ? [...props.portfolio.gallery_images]
    : props.portfolio?.image_url
    ? [props.portfolio.image_url]
    : [];

// If image_url not in gallery, add it
if (props.portfolio?.image_url && !initialGallery.includes(props.portfolio.image_url)) {
    initialGallery.unshift(props.portfolio.image_url);
}

const galleryItems = ref(
    initialGallery.map((url, index) => ({
        id: `existing-${index}-${Date.now()}`,
        url,
        file: null,
        isExisting: true,
    }))
);

const customImageUrl = ref('');
const fileInput = ref(null);

const form = useForm({
    service_id: props.portfolio?.service_id || '',
    category_id: props.portfolio?.category_id || '',
    category: props.portfolio?.category || 'website',
    title: props.portfolio?.title || '',
    slug: props.portfolio?.slug || '',
    client_name: props.portfolio?.client_name || '',
    description: props.portfolio?.description || '',
    image_url: props.portfolio?.image_url || initialGallery[0] || '',
    gallery_images: initialGallery,
    new_gallery_images: [],
    demo_url: props.portfolio?.demo_url || '',
    technologies_input: initialTechs,
    technologies: [],
    is_featured: props.portfolio ? Boolean(props.portfolio.is_featured) : false,
    sort_order: props.portfolio?.sort_order || 0,
});

// If no cover image set yet, set the first item
if (!form.image_url && galleryItems.value.length > 0) {
    form.image_url = galleryItems.value[0].url;
}

const handleFilesChange = (e) => {
    const files = Array.from(e.target.files || []);
    if (!files.length) return;

    files.forEach((file) => {
        const previewUrl = URL.createObjectURL(file);
        const item = {
            id: `new-${file.name}-${Date.now()}-${Math.random()}`,
            url: previewUrl,
            file: file,
            isExisting: false,
        };
        galleryItems.value.push(item);

        // If no cover is selected, set this newly uploaded file as cover preview
        if (!form.image_url) {
            form.image_url = previewUrl;
        }
    });

    if (fileInput.value) {
        fileInput.value.value = '';
    }
};

const triggerFileInput = () => {
    fileInput.value?.click();
};

const addCustomUrl = () => {
    const url = customImageUrl.value.trim();
    if (!url) return;

    if (!galleryItems.value.some((item) => item.url === url)) {
        galleryItems.value.push({
            id: `url-${Date.now()}`,
            url: url,
            file: null,
            isExisting: true,
        });

        if (!form.image_url) {
            form.image_url = url;
        }
    }
    customImageUrl.value = '';
};

const setAsCover = (item) => {
    form.image_url = item.url;
};

const removeGalleryItem = (itemToRemove) => {
    galleryItems.value = galleryItems.value.filter((item) => item.id !== itemToRemove.id);

    // If removed item was cover image, reassign to another item
    if (form.image_url === itemToRemove.url) {
        form.image_url = galleryItems.value.length > 0 ? galleryItems.value[0].url : '';
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

    // Separate existing URLs and newly uploaded files
    form.gallery_images = galleryItems.value
        .filter((item) => item.isExisting)
        .map((item) => item.url);

    form.new_gallery_images = galleryItems.value
        .filter((item) => !item.isExisting && item.file)
        .map((item) => item.file);

    // If form.image_url is a blob url (from a new file), pass the filename or let controller assign it
    if (form.image_url.startsWith('blob:')) {
        const matchingNewItem = galleryItems.value.find((item) => item.url === form.image_url);
        if (matchingNewItem && matchingNewItem.file) {
            // Controller will automatically match or pick the first new file
            form.image_url = '';
        }
    }

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
                    class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition shadow-2xs"
                >
                    <ArrowLeft class="h-4 w-4" />
                </Link>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        {{ isEdit ? 'Edit Portofolio & Galeri' : 'Tambah Portofolio & Galeri' }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-0.5">
                        Kelola foto-foto proyek (multi-gambar galeri), pilih cover utama, dan informasi lengkap proyek.
                    </p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <Card class="border-slate-200">
                    <form @submit.prevent="submit">
                        <CardContent class="space-y-7 p-6 sm:p-8">
                            <!-- Judul & Slug URL -->
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Judul Portofolio *
                                    </label>
                                    <Input v-model="form.title" placeholder="Contoh: E-Commerce & Company Profile Artisan Coffee" required />
                                    <span v-if="form.errors.title" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.title }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Slug URL (Halaman Detail)
                                    </label>
                                    <Input
                                        v-model="form.slug"
                                        placeholder="Kosongkan untuk otomatis (contoh: artisan-coffee)"
                                    />
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        URL: <span class="font-mono text-slate-600">virtarastudio.com/portofolio/{{ form.slug || 'slug-proyek' }}</span>
                                    </p>
                                    <span v-if="form.errors.slug" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.slug }}
                                    </span>
                                </div>
                            </div>

                            <!-- Kategori & Klien -->
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Kategori Jasa *
                                    </label>
                                    <select
                                        v-if="categories && categories.length > 0"
                                        v-model="form.category_id"
                                        class="flex h-11 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"
                                    >
                                        <option value="">-- Pilih Kategori Jasa --</option>
                                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                            {{ cat.name }}
                                        </option>
                                    </select>
                                    <select
                                        v-else
                                        v-model="form.category"
                                        class="flex h-11 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"
                                        required
                                    >
                                        <option value="website">Website (Web & Design)</option>
                                        <option value="android">Android App</option>
                                        <option value="game">Game Android</option>
                                        <option value="ar">AR (Augmented Reality)</option>
                                        <option value="vr">VR (Virtual Reality)</option>
                                    </select>
                                    <span v-if="form.errors.category_id || form.errors.category" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.category_id || form.errors.category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Klien & Relasi Layanan -->
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Nama Klien / Brand (Opsional)
                                    </label>
                                    <Input v-model="form.client_name" placeholder="Contoh: PT Artisan Roastery Indonesia" />
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

                            <!-- Multi-Image Gallery & Cover Selector -->
                            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-5 sm:p-6 space-y-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide">
                                                Galeri Foto Portofolio (Banyak Foto)
                                            </h3>
                                            <span class="rounded-full bg-orange-100 px-2.5 py-0.5 text-[11px] font-bold text-orange-800">
                                                {{ galleryItems.length }} Gambar
                                            </span>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-0.5">
                                            Upload multiple foto untuk galeri detail proyek. Klik bintang <strong>"Jadikan Cover"</strong> pada foto yang ingin dijadikan gambar utama.
                                        </p>
                                    </div>

                                    <Button
                                        type="button"
                                        variant="default"
                                        size="sm"
                                        class="gap-2 text-xs font-bold shrink-0"
                                        @click="triggerFileInput"
                                    >
                                        <Upload class="h-4 w-4" />
                                        Upload Foto Galeri
                                    </Button>
                                </div>

                                <input
                                    ref="fileInput"
                                    type="file"
                                    multiple
                                    accept="image/png,image/jpeg,image/jpg,image/webp,image/svg+xml"
                                    class="hidden"
                                    @change="handleFilesChange"
                                />

                                <!-- Gallery Grid -->
                                <div
                                    v-if="galleryItems.length > 0"
                                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3.5 pt-2"
                                >
                                    <div
                                        v-for="item in galleryItems"
                                        :key="item.id"
                                        class="group relative aspect-video rounded-xl border-2 overflow-hidden bg-white shadow-2xs transition-all duration-200"
                                        :class="[
                                            form.image_url === item.url
                                                ? 'border-orange-500 ring-2 ring-orange-500/20 shadow-md'
                                                : 'border-slate-200 hover:border-slate-300',
                                        ]"
                                    >
                                        <img
                                            :src="item.url"
                                            alt="Gallery item"
                                            class="h-full w-full object-cover"
                                        />

                                        <!-- Badge Cover -->
                                        <div
                                            v-if="form.image_url === item.url"
                                            class="absolute top-2 left-2 z-10 flex items-center gap-1 rounded-md bg-orange-600 px-2 py-0.5 text-[10px] font-bold text-white shadow-sm"
                                        >
                                            <Star class="h-3 w-3 fill-current" />
                                            <span>Cover Utama</span>
                                        </div>

                                        <!-- Action Overlay on Hover -->
                                        <div
                                            class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-between p-2"
                                        >
                                            <div class="flex justify-end">
                                                <button
                                                    type="button"
                                                    @click="removeGalleryItem(item)"
                                                    class="h-7 w-7 rounded-lg bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition shadow-sm"
                                                    title="Hapus gambar ini dari galeri"
                                                >
                                                    <Trash2 class="h-3.5 w-3.5" />
                                                </button>
                                            </div>

                                            <div v-if="form.image_url !== item.url">
                                                <button
                                                    type="button"
                                                    @click="setAsCover(item)"
                                                    class="w-full rounded-md bg-white/95 py-1 text-[11px] font-bold text-slate-800 hover:bg-orange-500 hover:text-white transition flex items-center justify-center gap-1 shadow-sm"
                                                >
                                                    <Star class="h-3 w-3" />
                                                    Jadikan Cover
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Empty Gallery State -->
                                <div
                                    v-else
                                    @click="triggerFileInput"
                                    class="flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-300 bg-white p-8 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50/20 transition group"
                                >
                                    <div class="h-12 w-12 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <ImageIcon class="h-6 w-6" />
                                    </div>
                                    <p class="text-xs font-bold text-slate-700">Belum ada foto dalam galeri</p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">
                                        Klik di sini untuk memilih satu atau beberapa file gambar sekaligus.
                                    </p>
                                </div>

                                <!-- Add via URL option -->
                                <div class="pt-3 border-t border-slate-200/80">
                                    <label class="block text-[11px] font-semibold text-slate-600 mb-1">
                                        Atau tambahkan URL gambar eksternal ke galeri:
                                    </label>
                                    <div class="flex gap-2">
                                        <div class="relative flex-1">
                                            <Input
                                                v-model="customImageUrl"
                                                placeholder="https://images.unsplash.com/..."
                                                class="text-xs h-9 pl-8"
                                                @keydown.enter.prevent="addCustomUrl"
                                            />
                                            <LinkIcon class="h-3.5 w-3.5 text-slate-400 absolute left-2.5 top-3" />
                                        </div>
                                        <Button
                                            type="button"
                                            variant="outline"
                                            size="sm"
                                            class="gap-1.5 text-xs font-semibold"
                                            @click="addCustomUrl"
                                        >
                                            <Plus class="h-3.5 w-3.5" />
                                            Tambah URL
                                        </Button>
                                    </div>
                                </div>

                                <span v-if="form.errors.new_gallery_images" class="text-xs text-red-500 block">
                                    {{ form.errors.new_gallery_images }}
                                </span>
                                <span v-if="form.errors.image_url" class="text-xs text-red-500 block">
                                    {{ form.errors.image_url }}
                                </span>
                            </div>

                            <!-- Deskripsi Lengkap Proyek -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                    Deskripsi Hasil Karya / Studi Kasus Proyek *
                                </label>
                                <Textarea
                                    v-model="form.description"
                                    rows="5"
                                    placeholder="Jelaskan secara mendalam tentang proyek ini, tantangan yang diselesaikan, fitur utama yang dibangun, dan manfaat bagi klien..."
                                    required
                                />
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
                                    <Input
                                        v-model="form.demo_url"
                                        placeholder="https://nama-website-klien.com (Kosongkan jika tidak ada)"
                                    />
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        Kosongkan jika proyek bersifat internal atau tidak memiliki link demo publik.
                                    </p>
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
                                        placeholder="Contoh: Laravel, Vue.js, Unity, WebXR, PostgreSQL"
                                    />
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        Teknologi akan ditampilkan sebagai tag fitur di halaman detail.
                                    </p>
                                    <span v-if="form.errors.technologies" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.technologies }}
                                    </span>
                                </div>
                            </div>

                            <!-- Urutan & Featured -->
                            <div class="flex items-center gap-6 pt-3 border-t border-slate-100">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                        Urutan Tampilan
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
                                        <span class="text-sm font-medium text-slate-700">Tandai sebagai Featured di Beranda</span>
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
                                class="gap-2 font-bold min-w-[160px]"
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
