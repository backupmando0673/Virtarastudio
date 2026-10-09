<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Landing/Navbar.vue';
import HeroSection from '@/Components/Landing/HeroSection.vue';
import ServicesSection from '@/Components/Landing/ServicesSection.vue';
import WhyUsSection from '@/Components/Landing/WhyUsSection.vue';
import PortfolioSection from '@/Components/Landing/PortfolioSection.vue';
import TestimonialsSection from '@/Components/Landing/TestimonialsSection.vue';
import FaqSection from '@/Components/Landing/FaqSection.vue';
import CtaBannerSection from '@/Components/Landing/CtaBannerSection.vue';
import Footer from '@/Components/Landing/Footer.vue';
import FloatingWhatsApp from '@/Components/Landing/FloatingWhatsApp.vue';

defineProps({
    canLogin: {
        type: Boolean,
        default: true,
    },
    settings: {
        type: Object,
        default: () => ({}),
    },
    services: {
        type: Array,
        default: () => [],
    },
    portfolios: {
        type: Array,
        default: () => [],
    },
    testimonials: {
        type: Array,
        default: () => [],
    },
    faqs: {
        type: Array,
        default: () => [],
    },
    whatsappUrl: {
        type: String,
        default: '#',
    },
});
</script>

<template>
    <Head>
        <title>{{ settings.site_name || 'Virtarastudio' }} - Jasa Website, Android, Game, AR & VR</title>
        <meta
            name="description"
            :content="settings.site_tagline || 'Layanan pembuatan website murah, aplikasi Android, game interaktif, AR, dan VR dengan konsultasi gratis via WhatsApp.'"
        />
        <link
            v-if="settings.site_favicon || $page.props.site_settings?.site_favicon"
            rel="icon"
            :href="settings.site_favicon || $page.props.site_settings.site_favicon"
        />
    </Head>

    <div class="min-h-screen bg-white text-slate-900 selection:bg-blue-600 selection:text-white font-sans antialiased">
        <!-- Sticky Navbar -->
        <Navbar
            :whatsapp-url="whatsappUrl"
            :site-name="settings.site_name"
            :site-logo="settings.site_logo"
        />

        <main>
            <!-- Hero Section -->
            <HeroSection
                :settings="settings"
                :whatsapp-url="whatsappUrl"
            />

            <!-- 5 Services Section -->
            <ServicesSection
                :services="services"
            />

            <!-- Why Choose Us -->
            <WhyUsSection />

            <!-- Portfolio Showcase -->
            <PortfolioSection
                :portfolios="portfolios"
            />

            <!-- Testimonials -->
            <TestimonialsSection
                :testimonials="testimonials"
            />

            <!-- FAQ Accordion -->
            <FaqSection
                :faqs="faqs"
            />

            <!-- CTA Banner -->
            <CtaBannerSection
                :whatsapp-url="whatsappUrl"
            />
        </main>

        <!-- Footer -->
        <Footer
            :settings="settings"
            :whatsapp-url="whatsappUrl"
            :services="services"
        />

        <!-- Floating WhatsApp Action Button -->
        <FloatingWhatsApp
            :whatsapp-url="whatsappUrl"
        />
    </div>
</template>
