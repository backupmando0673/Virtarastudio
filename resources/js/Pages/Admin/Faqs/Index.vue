<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { Plus, Edit3, Trash2, CheckCircle2, Check, X } from '@lucide/vue';

const props = defineProps({
    faqs: {
        type: Array,
        default: () => [],
    },
});

const editingFaq = ref(null);

const form = useForm({
    question: '',
    answer: '',
    category: 'Umum',
    sort_order: 0,
    is_active: true,
});

const startEdit = (faq) => {
    editingFaq.value = faq;
    form.question = faq.question;
    form.answer = faq.answer;
    form.category = faq.category || 'Umum';
    form.sort_order = faq.sort_order || 0;
    form.is_active = Boolean(faq.is_active);
};

const cancelEdit = () => {
    editingFaq.value = null;
    form.reset();
};

const submit = () => {
    if (editingFaq.value) {
        form.put(route('admin.faqs.update', editingFaq.value.id), {
            onSuccess: () => cancelEdit(),
        });
    } else {
        form.post(route('admin.faqs.store'), {
            onSuccess: () => form.reset(),
        });
    }
};

const deleteFaq = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus FAQ ini?')) {
        router.delete(route('admin.faqs.destroy', id));
    }
};
</script>

<template>
    <Head title="Kelola FAQ - Virtarastudio" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                    Kelola Tanya Jawab (FAQ)
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Daftar pertanyaan dan jawaban yang tampil pada accordion FAQ di landing page.
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
                    <!-- Left: FAQ Form (Add or Edit) -->
                    <div class="lg:col-span-5">
                        <Card class="border-slate-200 sticky top-24">
                            <CardHeader>
                                <CardTitle class="text-lg">
                                    {{ editingFaq ? 'Edit Pertanyaan FAQ' : 'Tambah FAQ Baru' }}
                                </CardTitle>
                            </CardHeader>
                            <form @submit.prevent="submit">
                                <CardContent class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                            Pertanyaan *
                                        </label>
                                        <Input
                                            v-model="form.question"
                                            placeholder="Contoh: Berapa lama pembuatan website?"
                                            required
                                        />
                                        <span v-if="form.errors.question" class="text-xs text-red-500 mt-1 block">
                                            {{ form.errors.question }}
                                        </span>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                            Jawaban Lengkap *
                                        </label>
                                        <Textarea
                                            v-model="form.answer"
                                            rows="4"
                                            placeholder="Tuliskan jawaban yang jelas dan ramah..."
                                            required
                                        />
                                        <span v-if="form.errors.answer" class="text-xs text-red-500 mt-1 block">
                                            {{ form.errors.answer }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                                Kategori
                                            </label>
                                            <Input v-model="form.category" placeholder="Umum" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">
                                                Urutan
                                            </label>
                                            <Input v-model="form.sort_order" type="number" min="0" />
                                        </div>
                                    </div>

                                    <div>
                                        <label class="inline-flex items-center gap-2 cursor-pointer mt-2">
                                            <input
                                                v-model="form.is_active"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-slate-300 text-orange-600 focus:ring-orange-500"
                                            />
                                            <span class="text-sm font-medium text-slate-700">Aktifkan di Landing Page</span>
                                        </label>
                                    </div>
                                </CardContent>

                                <CardFooter class="flex items-center justify-between border-t border-slate-100 p-6">
                                    <button
                                        v-if="editingFaq"
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
                                        class="gap-1.5 font-bold"
                                    >
                                        <Check class="h-4 w-4" />
                                        {{ form.processing ? 'Menyimpan...' : (editingFaq ? 'Simpan Perubahan' : 'Tambah FAQ') }}
                                    </Button>
                                </CardFooter>
                            </form>
                        </Card>
                    </div>

                    <!-- Right: FAQ List -->
                    <div class="lg:col-span-7 space-y-4">
                        <div
                            v-for="faq in faqs"
                            :key="faq.id"
                            class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-orange-200"
                        >
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="inline-block rounded-md bg-orange-50 px-2 py-0.5 text-[10px] font-bold text-orange-700 uppercase">
                                        {{ faq.category || 'Umum' }}
                                    </span>
                                    <h4 class="text-base font-bold text-slate-900 mt-2">
                                        {{ faq.question }}
                                    </h4>
                                    <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                                        {{ faq.answer }}
                                    </p>
                                </div>

                                <div class="flex items-center gap-1.5 shrink-0">
                                    <button
                                        type="button"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-600 hover:bg-orange-50 hover:text-orange-600 transition"
                                        @click="startEdit(faq)"
                                    >
                                        <Edit3 class="h-3.5 w-3.5" />
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-red-500 hover:bg-red-50 hover:text-red-700 transition"
                                        @click="deleteFaq(faq.id)"
                                    >
                                        <Trash2 class="h-3.5 w-3.5" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
