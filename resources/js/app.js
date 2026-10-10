import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// Umami Global Event Tracking Listener
if (typeof window !== 'undefined') {
    document.addEventListener('click', (e) => {
        const el = e.target.closest('a, button');
        if (!el || !window.umami) return;

        const href = el.getAttribute('href') || '';

        // Link WhatsApp
        if (href.includes('wa.me') || href.includes('whatsapp.com')) {
            window.umami.track('klik-whatsapp', {
                teks: el.textContent.trim().slice(0, 50),
            });
            return;
        }

        // Link anchor internal (misalnya #portfolio atau https://virtarastudio.com/#portfolio)
        let hash = '';
        if (href.startsWith('#')) {
            hash = href;
        } else if (href.includes('#')) {
            try {
                const url = new URL(href, window.location.origin);
                if (url.origin === window.location.origin) {
                    hash = url.hash;
                }
            } catch {
                // ignore
            }
        }

        if (hash && hash.length > 1) {
            window.umami.track('klik-menu', {
                tujuan: hash,
                teks: el.textContent.trim().slice(0, 50),
            });
        }
    });
}
