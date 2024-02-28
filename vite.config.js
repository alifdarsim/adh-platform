import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    css: {
        devSourcemap: process.env.APP_ENV === 'local', //
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/app.scss',
                'resources/scss/user/app.scss',
                'resources/scss/admin/app.scss',
                'resources/js/app.js'
            ],
            refresh: true,
            transformOnServe: (code) => {
                if (process.env.APP_ENV === 'production') {
                    return code.replaceAll('/assets', 'https://app.asiadealhub.com/assets');
                } else {
                    return code.replaceAll('/assets', 'http://localhost:8000/assets');
                }
            },
        }),
    ],
});
