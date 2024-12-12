import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/agente.css',     // estilos específicos de persona
                'resources/js/agente.js',
                'resources/css/persona.css',     // estilos específicos de persona
                'resources/js/persona.js',
                'resources/css/municipio.css',     // estilos específicos de persona
                'resources/js/municipio.js',
                'resources/css/usuarios.css',     // estilos específicos de persona
                'resources/js/usuarios.js',
                'resources/css/informe.css',     // estilos específicos de persona
                'resources/js/informe.js',
                'resources/css/notarial.css',     // estilos específicos de persona
                'resources/js/notarial.js',
                'resources/css/empresa.css',     // estilos específicos de persona
                'resources/js/empresa.js',
                'resources/css/juzgado.css',     // estilos específicos de persona
                'resources/js/juzgado.js',
                'resources/css/derechos.css',     // estilos específicos de persona
                'resources/js/derechos.js',
                'resources/css/sancion.css',     // estilos específicos de persona
                'resources/js/sancion.js',         // scripts específicos de persona
                'resources/css/comunicados.css',     // estilos específicos de persona
                'resources/js/comunicados.js'         // scripts específicos de persona
            ],
            refresh: true,
        }),
    ],
});
