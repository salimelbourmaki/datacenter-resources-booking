import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // CSS
                'resources/css/about.css',
                'resources/css/admin/logs.css',
                'resources/css/admin/users.css',
                'resources/css/auth/forgot-password.css',
                'resources/css/auth/login.css',
                'resources/css/auth/reset-password.css',
                'resources/css/dashboard.css',
                'resources/css/incidents/manager.css',
                'resources/css/layouts/app.css',
                'resources/css/profile.css',
                'resources/css/reservations/create.css',
                'resources/css/reservations/history.css',
                'resources/css/reservations/index.css',
                'resources/css/reservations/manager.css',
                'resources/css/resources/create.css',
                'resources/css/resources/edit.css',
                'resources/css/resources/index.css',
                'resources/css/resources/manager.css',
                // JS
                'resources/js/about.js',
                'resources/js/admin/dashboard.js',
                'resources/js/admin/logs.js',
                'resources/js/admin/users.js',
                'resources/js/auth/login.js',
                'resources/js/incidents/manager.js',
                'resources/js/layouts/app.js',
                'resources/js/notifications/index.js',
                'resources/js/profile.js',
                'resources/js/reservations/create.js',
                'resources/js/reservations/index.js',
                'resources/js/theme-init.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
