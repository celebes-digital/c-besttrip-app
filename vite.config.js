import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import livewire from '@defstudio/vite-livewire-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/filament/admin/theme.css",
            ],
            refresh: false,
        }),

        livewire({
            refresh: [
                ...refreshPaths,
                "app/Http/Livewire/**/*",
                "app/Forms/Components/**/*",
                "resources/css/filament/admin/theme.css",
                "resources/css/app.css",
            ],
        }),
    ],
});
