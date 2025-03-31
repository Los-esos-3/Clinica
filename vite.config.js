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
        host: 'localhost', // o '0.0.0.0' para acceso desde la red
        hmr: {
            host: 'localhost'
        },
    },
    // ... resto de tu configuración
});