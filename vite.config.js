import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command }) => ({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: command === 'serve' ? {
        host: 'expemed.up.railway.app',
        hmr: {
            host: 'expemed.up.railway.app'
        },
    } : undefined,
}));