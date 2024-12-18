import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/agente.css',
                'resources/js/agente.js',
                'resources/css/persona.css',
                'resources/js/persona.js',
                'resources/css/municipio.css',
                'resources/js/municipio.js',
                'resources/css/usuarios.css',
                'resources/js/usuarios.js',
                'resources/css/informe.css',
                'resources/js/informe.js',
                'resources/css/notarial.css',
                'resources/js/notarial.js',
                'resources/css/empresa.css',
                'resources/js/empresa.js',
                'resources/css/juzgado.css',
                'resources/js/juzgado.js',
                'resources/css/derechos.css',
                'resources/js/derechos.js',
                'resources/css/sancion.css',
                'resources/js/sancion.js',
                'resources/css/comunicados.css',
                'resources/js/comunicados.js',
                'resources/css/notificaciones.css',
                'resources/js/notificaciones.js',
                'resources/css/reportes.css',
                'resources/js/reportes.js',
                'resources/css/sanciones.css',
                'resources/js/sanciones.js'
            ],
            refresh: true,
        }),
    ],
});
