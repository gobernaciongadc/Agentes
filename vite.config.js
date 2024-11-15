import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/persona.css',     // estilos específicos de persona
                'resources/js/persona.js',
                'resources/css/municipio.css',     // estilos específicos de persona
                'resources/js/municipio.js'          // scripts específicos de persona
            ],
            refresh: true,
        }),
    ],
});
