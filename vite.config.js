import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js' // ← Verifica que esta ruta sea correcta
            ],
            refresh: true,
        }),
    ],
});