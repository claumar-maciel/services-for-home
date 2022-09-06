import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/scss/app.scss', 
                'resources/scss/auth.scss', 
                'resources/scss/panel.scss', 
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
