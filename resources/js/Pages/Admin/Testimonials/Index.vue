<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { Plus, Edit3, Trash2, CheckCircle2, Check, X, Star, Upload, User, Quote } from '@lucide/vue';

const props = defineProps({
    testimonials: {
        type: Array,
        default: () => [],
    },
});

const editingTestimonial = ref(null);
const avatarPreview = ref(null);

const form = useForm({
    client_name: '',
    client_role: '',
    company: '',
    avatar: null,
    avatar_url: '',
    rating: 5,
    content: '',
    is_featured: true,
    sort_order: 0,
    remove_avatar: false,
});

const handleAvatarChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.avatar = file;
        form.remove_avatar = false;
        avatarPreview.value = URL.createObjectURL(file);
    }
};

const removeAvatar = () => {
    form.avatar = null;
    form.avatar_url = '';
    form.remove_avatar = true;
    avatarPreview.value = null;
};

const startEdit = (testimonial) => {
    editingTestimonial.value = testimonial;
    form.client_name = testimonial.client_name || '';
    form.client_role = testimonial.client_role || '';
    form.company = testimonial.company || '';
    form.avatar = null;
    form.avatar_url = testimonial.avatar_url || '';
    form.rating = testimonial.rating || 5;
    form.content = testimonial.content || '';
    form.is_featured = Boolean(testimonial.is_featured);
    form.sort_order = testimonial.sort_order || 0;
    form.remove_avatar = false;

    avatarPreview.value = testimonial.avatar_url || null;
};

const cancelEdit = () => {
    editingTestimonial.value = null;
    avatarPreview.value = null;
    form.reset();
    form.clearErrors();
};

const submit = () => {
    if (editingTestimonial.value) {
        form.post(route('admin.testimonials.update', editingTestimonial.value.id), {
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => cancelEdit(),
        });
    } else {
        form.post(route('admin.testimonials.store'), {
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => cancelEdit(),
        });
    }
};

const deleteTestimonial = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus testimoni ini?')) {
        router.delete(route('admin.testimonials.destroy', id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Kelola Testimoni Klien - Virtarastudio" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        Kelola Testimoni Klien
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Daftar ulasan dan testimoni kepuasan klien yang tampil pada beranda website.
                    </p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Flash Message -->
                <div
                    v-if="$page.props.flash?.success"
                    class="mb-6 flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800 shadow-sm"
                >
                    <CheckCircle2 class="h-5 w-5 text-green-600 shrink-0" />
                    <span>{{ $page.props.flash.success }}</span>
                </div>

                <div class="grid gap-8 lg:grid-cols-12 items-start">
                    <!-- Left Column: Testimonial Form (Add / Edit) -->
                    <div class="lg:col-span-5">
                        <Card class="border-slate-200 shadow-xs sticky top-24">
                            <CardHeader class="border-b border-slate-100 bg-slate-50/50">
                                <CardTitle class="text-lg flex items-center gap-2">
                                    <Quote class="h-5 w-5 text-amber-500" />
                                    {{ editingTestimonial ? 'Edit Testimoni Klien' : 'Tambah Testimoni Baru' }}
                                </CardTitle>
                            </CardHeader>
                            <form @submit.prevent="submit">
                                <CardContent class="p-6 space-y-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                            Nama Lengkap Klien *
                                        </label>
                                        <Input
                                            v-model="form.client_name"
                                            placeholder="Contoh: Budi Pratama"
                                            required
                                        />
                                        <span v-if="form.errors.client_name" class="text-xs text-red-500 mt-1 block">
                                            {{ form.errors.client_name }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                                Jabatan / Peran
                                            </label>
                                            <Input
                                                v-model="form.client_role"
                                                placeholder="Contoh: Founder"
                                            />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                                Nama Perusahaan / Usaha
                                            </label>
                                            <Input
                                                v-model="form.company"
                                                placeholder="Contoh: Kopi Sentosa"
                                            />
                                        </div>
                                    </div>

                                    <!-- Rating Star Selection -->
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                            Rating Kepuasan (1 - 5 Bintang) *
                                        </label>
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center gap-1 bg-amber-50 px-3 py-1.5 rounded-xl border border-amber-200">
                                                <button
                                                    v-for="star in 5"
                                                    :key="star"
                                                    type="button"
                                                    class="focus:outline-none transition-transform hover:scale-125"
                                                    @click="form.rating = star"
                                                >
                                                    <Star
                                                        class="h-5 w-5"
                                                        :class="star <= form.rating ? 'fill-amber-400 text-amber-400' : 'text-slate-300'"
                                                    />
                                                </button>
                                            </div>
                                            <span class="text-xs font-bold text-amber-700 bg-amber-100 px-2 py-1 rounded-md">
                                                {{ form.rating }} / 5 Bintang
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Avatar Photo Upload -->
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                            Foto Profil / Avatar Klien
                                        </label>
                                        <div class="flex items-center gap-4">
                                            <div class="relative h-14 w-14 rounded-full border-2 border-slate-200 bg-slate-100 flex items-center justify-center overflow-hidden shrink-0">
                                                <img
                                                    v-if="avatarPreview"
                                                    :src="avatarPreview"
                                                    alt="Avatar Preview"
                                                    class="h-full w-full object-cover"
                                                />
                                                <User v-else class="h-6 w-6 text-slate-400" />
                                            </div>

                                            <div class="flex-1 space-y-1.5">
                                                <div class="flex items-center gap-2">
                                                    <label class="cursor-pointer inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 shadow-xs transition">
                                                        <Upload class="h-3.5 w-3.5 text-blue-600" />
                                                        <span>Unggah Foto</span>
                                                        <input
                                                            type="file"
                                                            accept="image/png, image/jpeg, image/webp"
                                                            class="hidden"
                                                            @change="handleAvatarChange"
                                                        />
                                                    </label>

                                                    <Button
                                                        v-if="avatarPreview"
                                                        type="button"
                                                        variant="ghost"
                                                        size="sm"
                                                        class="text-xs text-red-500 hover:text-red-700 hover:bg-red-50"
                                                        @click="removeAvatar"
                                                    >
                                                        Hapus
                                                    </Button>
                                                </div>
                                                <p class="text-[11px] text-slate-400">PNG, JPG, WebP. Maks 2MB.</p>
                                            </div>
                                        </div>
                                        <span v-if="form.errors.avatar" class="text-xs text-red-500 mt-1 block">
                                            {{ form.errors.avatar }}
                                        </span>
                                    </div>

                                    <!-- Testimonial Content Textarea -->
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                            Isi Testimoni / Ulasan Klien *
                                        </label>
                                        <Textarea
                                            v-model="form.content"
                                            rows="4"
                                            placeholder="Tuliskan ulasan jujur atau kesan pesan dari klien..."
                                            required
                                        />
                                        <span v-if="form.errors.content" class="text-xs text-red-500 mt-1 block">
                                            {{ form.errors.content }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3 pt-1">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                                Urutan Tampil
                                            </label>
                                            <Input v-model="form.sort_order" type="number" min="0" />
                                        </div>
                                        <div class="flex items-end">
                                            <label class="inline-flex items-center gap-2 cursor-pointer mb-2">
                                                <input
                                                    v-model="form.is_featured"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-slate-300 text-amber-500 focus:ring-amber-400"
                                                />
                                                <span class="text-xs font-semibold text-slate-700">Tampilkan di Beranda</span>
                                            </label>
                                        </div>
                                    </div>
                                </CardContent>

                                <CardFooter class="flex items-center justify-between border-t border-slate-100 p-6 bg-slate-50/50">
                                    <button
                                        v-if="editingTestimonial"
                                        type="button"
                                        class="text-xs font-semibold text-slate-500 hover:text-slate-800"
                                        @click="cancelEdit"
                                    >
                                        Batal Edit
                                    </button>
                                    <span v-else></span>

                                    <Button
                                        type="submit"
                                        :disabled="form.processing"
                                        variant="default"
                                        class="gap-1.5 font-bold bg-amber-500 hover:bg-amber-600 text-white shadow-sm border-0"
                                    >
                                        <Check class="h-4 w-4" />
                                        {{ form.processing ? 'Menyimpan...' : (editingTestimonial ? 'Simpan Perubahan' : 'Tambah Testimoni') }}
                                    </Button>
                                </CardFooter>
                            </form>
                        </Card>
                    </div>

                    <!-- Right Column: Testimonial Cards List -->
                    <div class="lg:col-span-7 space-y-4">
                        <div class="flex items-center justify-between px-1">
                            <h3 class="text-base font-bold text-slate-900">
                                Daftar Testimoni ({{ testimonials.length }})
                            </h3>
                        </div>

                        <div v-if="testimonials.length === 0" class="rounded-2xl border border-slate-200 bg-white p-8 text-center text-slate-500">
                            Belum ada testimoni klien. Silakan tambahkan melalui form di samping.
                        </div>

                        <div
                            v-for="t in testimonials"
                            :key="t.id"
                            class="rounded-2xl border border-slate-200 bg-white p-5 shadow-xs transition hover:border-amber-300 relative group"
                        >
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-start gap-3.5">
                                    <!-- Avatar Image or Initial -->
                                    <div class="h-12 w-12 rounded-full border border-slate-200 bg-slate-100 flex items-center justify-center overflow-hidden shrink-0 shadow-xs">
                                        <img
                                            v-if="t.avatar_url"
                                            :src="t.avatar_url"
                                            :alt="t.client_name"
                                            class="h-full w-full object-cover"
                                        />
                                        <div v-else class="h-full w-full bg-amber-500 text-white font-bold flex items-center justify-center text-lg">
                                            {{ t.client_name ? t.client_name.charAt(0).toUpperCase() : 'C' }}
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="text-base font-bold text-slate-900">
                                                {{ t.client_name }}
                                            </h4>
                                            <span
                                                v-if="t.is_featured"
                                                class="rounded-full bg-amber-100 px-2 py-0.5 text-[10px] font-bold text-amber-800"
                                            >
                                                Tampil di Beranda
                                            </span>
                                        </div>

                                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                                            <span v-if="t.client_role">{{ t.client_role }}</span>
                                            <span v-if="t.client_role && t.company"> &bull; </span>
                                            <span v-if="t.company" class="text-amber-600 font-semibold">{{ t.company }}</span>
                                        </p>

                                        <!-- Rating Stars -->
                                        <div class="flex items-center gap-0.5 mt-2">
                                            <Star
                                                v-for="s in 5"
                                                :key="s"
                                                class="h-4 w-4"
                                                :class="s <= t.rating ? 'fill-amber-400 text-amber-400' : 'text-slate-200'"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <button
                                        type="button"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-slate-100 text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition"
                                        title="Edit Testimoni"
                                        @click="startEdit(t)"
                                    >
                                        <Edit3 class="h-3.5 w-3.5" />
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-slate-100 text-red-500 hover:bg-red-50 hover:text-red-700 transition"
                                        title="Hapus Testimoni"
                                        @click="deleteTestimonial(t.id)"
                                    >
                                        <Trash2 class="h-3.5 w-3.5" />
                                    </button>
                                </div>
                            </div>

                            <!-- Content Quote Box -->
                            <div class="mt-4 rounded-xl bg-slate-50 p-3.5 text-xs text-slate-700 leading-relaxed italic border border-slate-100">
                                &ldquo;{{ t.content }}&rdquo;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
