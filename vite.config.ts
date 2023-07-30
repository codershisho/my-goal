import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import vuetify from 'vite-plugin-vuetify'
import { VitePluginFonts } from 'vite-plugin-fonts' // 追加
import tsconfigPaths from 'vite-tsconfig-paths'

export default defineConfig({
  plugins: [
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    vuetify({ autoImport: true }),
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.ts',
        'resources/sass/app.scss',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
    VitePluginFonts({
      google: {
        families: ['Noto Sans JP'],
      },
    }),
    tsconfigPaths(),
  ],
  // 下記を追加する
  resolve: {
    alias: {
      '@': '/resources/js',
      vue: 'vue/dist/vue.esm-bundler.js',
    },
  },
  server: {
    hmr: {
      host: 'localhost',
    },
  },
})
