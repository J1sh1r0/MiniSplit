import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [laravel([
        'resources/css/app.css',
        'resources/css/landing.css',
        'resources/js/app.js',
        'resources/js/landing.js',
        'resources/js/cart.js',
        'resources/js/modal.js',
        'resources/js/menu.js',
    ])],
});
