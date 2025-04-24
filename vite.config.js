import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
    vue(), // Add vue plugin here within the plugins array
  ],
  define: {
    'window.jQuery': 'jquery',
    'window.$': 'jquery',
  },
});
