<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardContent } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Badge } from '@/Components/ui/badge';
import { Plus, Edit3, Trash2, CheckCircle2, ExternalLink } from '@lucide/vue';

const props = defineProps({
    portfolios: {
        type: Array,
        default: () => [],
    },
});

const deleteItem = (id, title) => {
    if (confirm(`Apakah Anda yakin ingin menghapus portofolio "${title}"?`)) {
        router.delete(route('admin.portfolios.destroy', id));
    }
};
</script>

<template>
    <Head title="Kelola Portofolio - Virtarastudio" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        Portofolio Projek
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Daftar karya dan showcase hasil pengerjaan tim Virtarastudio.
                    </p>
                </div>

                <Button
                    as="a"
                    :href="route('admin.portfolios.create')"
                    variant="default"
                    class="gap-2 font-bold"
                >
                    <Plus class="h-4 w-4" />
                    Tambah Portofolio
                </Button>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-6">
                <!-- Flash Message -->
                <div
                    v-if="$page.props.flash?.success"
                    class="flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800 shadow-sm"
                >
                    <CheckCircle2 class="h-5 w-5 text-green-600 shrink-0" />
                    <span>{{ $page.props.flash.success }}</span>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <Card
                        v-for="item in portfolios"
                        :key="item.id"
                        class="overflow-hidden border-slate-200 hover:border-orange-300 transition shadow-sm flex flex-col justify-between"
                    >
                        <div>
                            <!-- Image -->
                            <div class="aspect-video w-full bg-slate-100 overflow-hidden relative">
                                <img
                                    v-if="item.image_url"
                                    :src="item.image_url"
                                    :alt="item.title"
                                    class="h-full w-full object-cover"
                                />
                                <div v-else class="h-full w-full flex items-center justify-center text-slate-400 text-xs">
                                    Tidak ada gambar
                                </div>
                                <div class="absolute top-3 left-3">
                                    <Badge variant="orangeSoft" class="capitalize font-bold text-[10px]">
                                        {{ item.category }}
                                    </Badge>
                                </div>
                            </div>

                            <div class="p-5">
                                <span v-if="item.client_name" class="text-xs text-slate-400 block font-medium">
                                    {{ item.client_name }}
                                </span>
                                <h3 class="text-base font-bold text-slate-900 mt-1">
                                    {{ item.title }}
                                </h3>
                                <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                    {{ item.description }}
                                </p>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 p-4 flex items-center justify-between bg-slate-50/50">
                            <a
                                v-if="item.demo_url"
                                :href="item.demo_url"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-1 text-xs font-semibold text-slate-600 hover:text-orange-600"
                            >
                                <span>Preview</span>
                                <ExternalLink class="h-3 w-3" />
                            </a>
                            <span v-else></span>

                            <div class="flex items-center gap-2">
                                <Link
                                    :href="route('admin.portfolios.edit', item.id)"
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-orange-600 hover:border-orange-300 transition"
                                >
                                    <Edit3 class="h-3.5 w-3.5" />
                                </Link>
                                <button
                                    type="button"
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-white border border-slate-200 text-red-500 hover:bg-red-50 hover:border-red-300 transition"
                                    @click="deleteItem(item.id, item.title)"
                                >
                                    <Trash2 class="h-3.5 w-3.5" />
                                </button>
                            </div>
                        </div>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
