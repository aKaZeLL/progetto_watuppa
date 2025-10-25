import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'

// https://vite.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    vueDevTools(),
  ],
  // VITE CONFIGURAZIONE PER IL SUPPORTO ES5
  build: {
    // Questa opzione dice a Vite di non usare i moderni moduli ES.
    // Forza la transpilazione per un supporto browser più ampio (Legacy).
    target: 'es2015', 

    // Puoi anche specificare target più vecchi se necessario, ad esempio:
    // target: ['es2015', 'chrome60', 'safari10'],
  },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
  },
})
