import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/all.min.css',
                'resources/css/app.css',
                'resources/css/bootstrap.rtl.css',
                'resources/css/owl.carousel.min.css',
                'resources/css/owl.theme.default.min.css',
                'resources/css/style.css',
                'resources/js/app.js',
                'resources/js/bootstrap.bundle.min.js',
                'resources/js/bootstrap.js',
                'resources/js/countfect.min.js',
                'resources/js/jquery.min.js',
                'resources/js/owl.carousel.min.js',
                'resources/js/script.js',
                'resources/images/logo.jpg',
            ],
            refresh: true,
        }),
    ],
});
