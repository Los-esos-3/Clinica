import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '192.168.1.97',
        hmr: {
            host: '192.168.1.97'
        },
    },
    build: {
        // Habilitar minificación
        minify: 'terser',
        // Dividir el código en chunks más pequeños
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['@/vendor'],
                }
            }
        },
        // Comprimir assets
        assetsInlineLimit: 4096,
        chunkSizeWarningLimit: 1000,
    }
});