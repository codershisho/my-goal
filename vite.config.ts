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
          // Vueプラグインは、Single File Componentsで
          // 参照する場合、アセットのURLをLaravelのWebサーバを
          // 指すように書き換えます。
          // これを`null`に設定すると、Laravelプラグインは
          // アセットURLをViteサーバを指すように書き換えます。
          base: null,

          // Vueプラグインは、絶対URLを解析し、ディスク上のファイルへの
          // 絶対パスとして扱います。
          // これを`false`に設定すると、絶対URLはそのままになり、
          // 期待通りにpublicディレクトリの中で、アセットへ参照できます。
          includeAbsolute: false,
        },
      },
    }),
    vuetify({ autoImport: true }),
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.ts'],
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
    },
  },
  server: {
    hmr: {
      host: 'localhost',
    },
  },
})
