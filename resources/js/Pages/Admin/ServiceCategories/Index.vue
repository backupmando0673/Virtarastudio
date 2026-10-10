<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardContent } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { Badge } from '@/Components/ui/badge';
import {
    Plus,
    Edit3,
    Trash2,
    CheckCircle2,
    Check,
    X,
    FolderKanban,
    Globe,
    Smartphone,
    Gamepad2,
    Scan,
    Glasses,
    Layers,
    Palette,
    Cpu,
} from '@lucide/vue';

const props = defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
});

const availableIcons = [
    { label: 'Globe (Website)', value: 'Globe' },
    { label: 'Smartphone (Mobile/Android)', value: 'Smartphone' },
    { label: 'Gamepad2 (Game)', value: 'Gamepad2' },
    { label: 'Scan (AR / Scanner)', value: 'Scan' },
    { label: 'Glasses (VR / Virtual Reality)', value: 'Glasses' },
    { label: 'Layers (Desain / Multiplatform)', value: 'Layers' },
    { label: 'Palette (Desain Grafis / Seni)', value: 'Palette' },
    { label: 'Cpu (Sistem / Teknologi)', value: 'Cpu' },
];

const getIconComponent = (iconName) => {
    switch (iconName) {
        case 'Smartphone':
            return Smartphone;
        case 'Gamepad2':
            return Gamepad2;
        case 'Scan':
            return Scan;
        case 'Glasses':
            return Glasses;
        case 'Layers':
            return Layers;
        case 'Palette':
            return Palette;
        case 'Cpu':
            return Cpu;
        default:
            return Globe;
    }
};

const editingCategory = ref(null);

const form = useForm({
    name: '',
    slug: '',
    pillar: 'tech',
    icon_name: 'Globe',
    description: '',
    sort_order: 0,
    is_active: true,
});

const startEdit = (cat) => {
    editingCategory.value = cat;
    form.name = cat.name;
    form.slug = cat.slug;
    form.pillar = cat.pillar || 'tech';
    form.icon_name = cat.icon_name || 'Globe';
    form.description = cat.description || '';
    form.sort_order = cat.sort_order || 0;
    form.is_active = Boolean(cat.is_active);
};

const cancelEdit = () => {
    editingCategory.value = null;
    form.reset();
};

const submit = () => {
    if (editingCategory.value) {
        form.put(route('admin.service-categories.update', editingCategory.value.id), {
            onSuccess: () => cancelEdit(),
        });
    } else {
        form.post(route('admin.service-categories.store'), {
            onSuccess: () => form.reset(),
        });
    }
};

const deleteCategory = (cat) => {
    if (confirm(`Apakah Anda yakin ingin menghapus kategori "${cat.name}"?`)) {
        router.delete(route('admin.service-categories.destroy', cat.id));
    }
};
</script>

<template>
    <Head title="Kelola Kategori Jasa - Virtarastudio" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                    Kelola Kategori Jasa
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Atur kategori layanan dan portofolio studio (misal: Website, Android App, Game, AR, VR) yang otomatis sinkron dengan filter landing page.
                </p>
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

                <div class="grid gap-8 lg:grid-cols-12">
                    <!-- Left: Form (Add or Edit) -->
                    <div class="lg:col-span-5">
                        <Card class="border-slate-200 sticky top-24 shadow-xs">
                            <CardHeader>
                                <CardTitle class="text-lg">
                                    {{ editingCategory ? 'Edit Kategori Jasa' : 'Tambah Kategori Jasa Baru' }}
                                </CardTitle>
                            </CardHeader>
                            <form @submit.prevent="submit">
                                <CardContent class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                            Nama Kategori *
                                        </label>
                                        <Input
                                            v-model="form.name"
                                            placeholder="Contoh: Web Design & Development"
                                            required
                                        />
                                        <span v-if="form.errors.name" class="text-xs text-red-500 mt-1 block">
                                            {{ form.errors.name }}
                                        </span>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                            Slug URL / Identifier
                                        </label>
                                        <Input
                                            v-model="form.slug"
                                            placeholder="Kosongkan untuk otomatis dibuat dari nama (contoh: web-design)"
                                        />
                                        <span v-if="form.errors.slug" class="text-xs text-red-500 mt-1 block">
                                            {{ form.errors.slug }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                                Pilar / Nuansa *
                                            </label>
                                            <select
                                                v-model="form.pillar"
                                                class="flex h-11 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"
                                            >
                                                <option value="art">Seni & Desain (Art)</option>
                                                <option value="tech">Teknologi & Engineering (Tech)</option>
                                            </select>
                                            <span v-if="form.errors.pillar" class="text-xs text-red-500 mt-1 block">
                                                {{ form.errors.pillar }}
                                            </span>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                                Ikon Lucide *
                                            </label>
                                            <select
                                                v-model="form.icon_name"
                                                class="flex h-11 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"
                                            >
                                                <option v-for="ic in availableIcons" :key="ic.value" :value="ic.value">
                                                    {{ ic.label }}
                                                </option>
                                            </select>
                                            <span v-if="form.errors.icon_name" class="text-xs text-red-500 mt-1 block">
                                                {{ form.errors.icon_name }}
                                            </span>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                            Deskripsi Ringkas (Opsional)
                                        </label>
                                        <Textarea
                                            v-model="form.description"
                                            placeholder="Deskripsi singkat mengenai kategori jasa ini..."
                                            rows="2"
                                        />
                                        <span v-if="form.errors.description" class="text-xs text-red-500 mt-1 block">
                                            {{ form.errors.description }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                                Urutan Tampil
                                            </label>
                                            <Input
                                                v-model.number="form.sort_order"
                                                type="number"
                                                placeholder="0"
                                            />
                                        </div>

                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                                Status Aktif
                                            </label>
                                            <label class="flex items-center gap-2 mt-2.5 cursor-pointer">
                                                <input
                                                    type="checkbox"
                                                    v-model="form.is_active"
                                                    class="h-4 w-4 rounded text-orange-500 focus:ring-orange-500"
                                                />
                                                <span class="text-sm text-slate-700 font-medium">Tampilkan di Publik</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="pt-2 flex items-center gap-2">
                                        <Button
                                            type="submit"
                                            :disabled="form.processing"
                                            class="flex-1 gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold"
                                        >
                                            <Check v-if="editingCategory" class="h-4 w-4" />
                                            <Plus v-else class="h-4 w-4" />
                                            {{ editingCategory ? 'Simpan Perubahan' : 'Tambah Kategori' }}
                                        </Button>

                                        <Button
                                            v-if="editingCategory"
                                            type="button"
                                            variant="outline"
                                            @click="cancelEdit"
                                        >
                                            <X class="h-4 w-4" />
                                            Batal
                                        </Button>
                                    </div>
                                </CardContent>
                            </form>
                        </Card>
                    </div>

                    <!-- Right: Categories List Table -->
                    <div class="lg:col-span-7">
                        <Card class="border-slate-200 shadow-xs">
                            <CardHeader class="flex flex-row items-center justify-between">
                                <CardTitle class="text-lg">
                                    Daftar Kategori Jasa ({{ categories.length }})
                                </CardTitle>
                            </CardHeader>
                            <CardContent class="p-0">
                                <div v-if="categories.length === 0" class="p-8 text-center text-slate-500">
                                    <FolderKanban class="mx-auto h-12 w-12 text-slate-300 mb-2" />
                                    Belum ada kategori jasa. Silakan tambahkan melalui form di samping.
                                </div>

                                <div v-else class="divide-y divide-slate-100">
                                    <div
                                        v-for="cat in categories"
                                        :key="cat.id"
                                        class="p-4 sm:p-5 flex items-start justify-between gap-4 hover:bg-slate-50/70 transition"
                                        :class="{ 'bg-orange-50/50': editingCategory?.id === cat.id }"
                                    >
                                        <div class="flex items-start gap-3 min-w-0">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl font-bold"
                                                :class="cat.pillar === 'art' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700'"
                                            >
                                                <component :is="getIconComponent(cat.icon_name)" class="h-5 w-5" />
                                            </div>

                                            <div class="space-y-1 min-w-0">
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <h4 class="font-bold text-slate-900 text-base">
                                                        {{ cat.name }}
                                                    </h4>
                                                    <Badge
                                                        variant="outline"
                                                        :class="cat.pillar === 'art' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-blue-50 text-blue-700 border-blue-200'"
                                                        class="text-[11px] font-semibold"
                                                    >
                                                        {{ cat.pillar === 'art' ? 'Seni & Desain' : 'Teknologi' }}
                                                    </Badge>
                                                    <Badge v-if="!cat.is_active" variant="outline" class="bg-red-50 text-red-700 border-red-200 text-[11px]">
                                                        Nonaktif
                                                    </Badge>
                                                </div>

                                                <p v-if="cat.description" class="text-xs text-slate-500 line-clamp-2">
                                                    {{ cat.description }}
                                                </p>

                                                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500 pt-1 font-mono">
                                                    <span class="bg-slate-100 px-2 py-0.5 rounded text-slate-600">
                                                        slug: {{ cat.slug }}
                                                    </span>
                                                    <span>Urutan: {{ cat.sort_order }}</span>
                                                    <span class="text-slate-400">&bull;</span>
                                                    <span>{{ cat.services_count || 0 }} Layanan</span>
                                                    <span class="text-slate-400">&bull;</span>
                                                    <span>{{ cat.portfolios_count || 0 }} Portofolio</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-1 shrink-0">
                                            <Button
                                                variant="ghost"
                                                size="sm"
                                                class="h-8 w-8 p-0 text-slate-600 hover:text-orange-600 hover:bg-orange-50"
                                                @click="startEdit(cat)"
                                                title="Edit"
                                            >
                                                <Edit3 class="h-4 w-4" />
                                            </Button>

                                            <Button
                                                variant="ghost"
                                                size="sm"
                                                class="h-8 w-8 p-0 text-slate-400 hover:text-red-600 hover:bg-red-50"
                                                @click="deleteCategory(cat)"
                                                title="Hapus"
                                            >
                                                <Trash2 class="h-4 w-4" />
                                            </Button>
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
