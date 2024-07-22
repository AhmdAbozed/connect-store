import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import { resolve } from 'url';
import path from 'path';
export default defineConfig({
    resolve: {
        alias: {
            '@/': path.resolve(__dirname, 'resources')
        }
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
