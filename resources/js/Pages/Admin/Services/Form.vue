<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import {
    ArrowLeft,
    Check,
    Globe,
    Smartphone,
    Gamepad2,
    Scan,
    Glasses,
    Layers,
} from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps({
    service: {
        type: Object,
        default: null,
    },
    categories: {
        type: Array,
        default: () => [],
    },
});

const isEditing = computed(() => Boolean(props.service && props.service.id));

const initialFeaturesText = computed(() => {
    if (!props.service || !props.service.features) return '';
    return Array.isArray(props.service.features)
        ? props.service.features.join('\n')
        : '';
});

const form = useForm({
    category_id: props.service?.category_id || '',
    name: props.service?.name || '',
    tagline: props.service?.tagline || '',
    description: props.service?.description || '',
    icon_name: props.service?.icon_name || 'Globe',
    starting_price: props.service?.starting_price || '',
    features_input: initialFeaturesText.value,
    whatsapp_template: props.service?.whatsapp_template || '',
    is_featured: props.service ? Boolean(props.service.is_featured) : true,
    is_active: props.service ? Boolean(props.service.is_active) : true,
    sort_order: props.service?.sort_order ?? 0,
});

const availableIcons = [
    { name: 'Globe', label: 'Website / Web', icon: Globe },
    { name: 'Smartphone', label: 'Aplikasi Android', icon: Smartphone },
    { name: 'Gamepad2', label: 'Game Android', icon: Gamepad2 },
    { name: 'Scan', label: 'Augmented Reality (AR)', icon: Scan },
    { name: 'Glasses', label: 'Virtual Reality (VR)', icon: Glasses },
    { name: 'Layers', label: 'Lainnya / Umum', icon: Layers },
];

const submit = () => {
    const featuresArray = form.features_input
        .split('\n')
        .map((f) => f.trim())
        .filter((f) => f.length > 0);

    const payload = {
        category_id: form.category_id || null,
        name: form.name,
        tagline: form.tagline,
        description: form.description,
        icon_name: form.icon_name,
        starting_price: form.starting_price,
        features: featuresArray,
        whatsapp_template: form.whatsapp_template,
        is_featured: form.is_featured,
        is_active: form.is_active,
        sort_order: Number(form.sort_order),
    };

    if (isEditing.value) {
        form.transform(() => payload).put(route('admin.services.update', props.service.id));
    } else {
        form.transform(() => payload).post(route('admin.services.store'));
    }
};
</script>

<template>
    <Head :title="isEditing ? `Edit Layanan: ${service.name} - Virtarastudio` : 'Tambah Layanan Baru - Virtarastudio'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link
                    :href="route('admin.services.index')"
                    class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition shadow-sm"
                >
                    <ArrowLeft class="h-4 w-4" />
                </Link>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        {{ isEditing ? `Edit Layanan: ${service.name}` : 'Tambah Layanan Baru' }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-0.5">
                        {{ isEditing ? 'Perbarui informasi dan rincian penawaran layanan.' : 'Buat layanan baru yang akan ditampilkan di landing page Virtarastudio.' }}
                    </p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <Card class="border-slate-200 shadow-sm">
                    <form @submit.prevent="submit">
                        <CardContent class="space-y-6 p-6 sm:p-8">
                            <!-- Basic Information -->
                            <div class="grid gap-4 sm:grid-cols-3">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Nama Layanan *
                                    </label>
                                    <Input
                                        v-model="form.name"
                                        placeholder="Contoh: Pembuatan Website Modern"
                                        required
                                    />
                                    <span v-if="form.errors.name" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.name }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Kategori Jasa
                                    </label>
                                    <select
                                        v-model="form.category_id"
                                        class="flex h-11 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"
                                    >
                                        <option value="">-- Pilih Kategori Jasa --</option>
                                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                            {{ cat.name }} ({{ cat.pillar === 'art' ? 'Seni' : 'Tech' }})
                                        </option>
                                    </select>
                                    <span v-if="form.errors.category_id" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.category_id }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Tagline / Slogan
                                    </label>
                                    <Input
                                        v-model="form.tagline"
                                        placeholder="Contoh: Cepat, Elegan, & SEO"
                                    />
                                    <span v-if="form.errors.tagline" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.tagline }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Harga Mulai Dari *
                                    </label>
                                    <Input
                                        v-model="form.starting_price"
                                        placeholder="Contoh: Rp 499.000"
                                        required
                                    />
                                    <span v-if="form.errors.starting_price" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.starting_price }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Urutan Tampilan
                                    </label>
                                    <Input
                                        v-model="form.sort_order"
                                        type="number"
                                        min="0"
                                    />
                                    <span v-if="form.errors.sort_order" class="text-xs text-red-500 mt-1 block">
                                        {{ form.errors.sort_order }}
                                    </span>
                                </div>
                            </div>

                            <!-- Icon Selector -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                                    Ikon Layanan *
                                </label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 mb-2">
                                    <button
                                        v-for="iconItem in availableIcons"
                                        :key="iconItem.name"
                                        type="button"
                                        @click="form.icon_name = iconItem.name"
                                        :class="[
                                            'flex items-center gap-2.5 p-2.5 rounded-xl border text-left text-xs font-medium transition',
                                            form.icon_name === iconItem.name
                                                ? 'border-blue-600 bg-blue-50 text-blue-700 ring-1 ring-blue-600'
                                                : 'border-slate-200 hover:border-slate-300 text-slate-700 bg-white'
                                        ]"
                                    >
                                        <component :is="iconItem.icon" class="h-4 w-4 shrink-0" />
                                        <span class="truncate">{{ iconItem.label }}</span>
                                    </button>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-slate-500">Ikon Terpilih:</span>
                                    <Input
                                        v-model="form.icon_name"
                                        class="h-8 text-xs max-w-[200px]"
                                        placeholder="Nama ikon lucide"
                                        required
                                    />
                                </div>
                                <span v-if="form.errors.icon_name" class="text-xs text-red-500 mt-1 block">
                                    {{ form.errors.icon_name }}
                                </span>
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Deskripsi Layanan *
                                </label>
                                <Textarea
                                    v-model="form.description"
                                    rows="3"
                                    placeholder="Jelaskan secara ringkas manfaat dan keunggulan layanan ini untuk klien..."
                                    required
                                />
                                <span v-if="form.errors.description" class="text-xs text-red-500 mt-1 block">
                                    {{ form.errors.description }}
                                </span>
                            </div>

                            <!-- Features Checklist -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Daftar Poin Fitur (Pisahkan setiap poin dengan Enter)
                                </label>
                                <Textarea
                                    v-model="form.features_input"
                                    rows="4"
                                    placeholder="Gratis Domain & Cloud Hosting&#10;Desain Custom & Responsif Mobile&#10;Integrasi WhatsApp & Form Kontak&#10;Optimasi Kecepatan & SEO Google"
                                />
                                <span class="text-[11px] text-slate-500 mt-1 block">
                                    Setiap baris teks akan otomatis menjadi poin checklist bertanda centang di landing page.
                                </span>
                            </div>

                            <!-- WhatsApp Template -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Template Pesan WhatsApp Otomatis
                                </label>
                                <Textarea
                                    v-model="form.whatsapp_template"
                                    rows="3"
                                    placeholder="Halo Virtarastudio, saya tertarik untuk konsultasi layanan ini..."
                                />
                                <span class="text-[11px] text-slate-500 mt-1 block">
                                    Pesan ini akan otomatis mengisi chat WhatsApp saat pengunjung menekan tombol konsultasi di layanan ini.
                                </span>
                            </div>

                            <!-- Status -->
                            <div class="pt-2 border-t border-slate-100 space-y-3">
                                <label class="inline-flex items-center gap-2.5 cursor-pointer block">
                                    <input
                                        v-model="form.is_featured"
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-slate-300 text-amber-500 focus:ring-amber-400"
                                    />
                                    <span class="text-sm font-medium text-slate-800">
                                        Jadikan Layanan Unggulan (Tampilkan di Halaman Utama)
                                    </span>
                                </label>

                                <label class="inline-flex items-center gap-2.5 cursor-pointer block">
                                    <input
                                        v-model="form.is_active"
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                    />
                                    <span class="text-sm font-medium text-slate-800">
                                        Status Layanan Aktif
                                    </span>
                                </label>
                            </div>
                        </CardContent>

                        <CardFooter class="flex items-center justify-between border-t border-slate-100 p-6 bg-slate-50/50 rounded-b-xl">
                            <Link
                                :href="route('admin.services.index')"
                                class="text-xs font-semibold text-slate-500 hover:text-slate-800 transition"
                            >
                                Batal
                            </Link>

                            <Button
                                type="submit"
                                :disabled="form.processing"
                                variant="default"
                                size="lg"
                                class="gap-2 font-bold min-w-[150px]"
                            >
                                <Check class="h-4 w-4" />
                                {{ form.processing ? 'Menyimpan...' : (isEditing ? 'Perbarui Layanan' : 'Simpan Layanan Baru') }}
                            </Button>
                        </CardFooter>
                    </form>
                </Card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
