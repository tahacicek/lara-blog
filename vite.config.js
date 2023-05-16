import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/guest/app.css',
                'resources/js/app.js',
                'resources/js/guest/app.js',
            ],
            refresh: true,
        }),
    ],
});
