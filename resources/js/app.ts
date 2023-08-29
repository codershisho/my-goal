import './bootstrap'
import 'vuetify/styles' // Global CSS has to be imported
import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import App from './App.vue'
// Route設定は次に行います
import router from './router'
// Store設定
import { createPinia } from 'pinia'
import { createPersistedState } from 'pinia-plugin-persistedstate'
// icon settings
import '@fortawesome/fontawesome-free/css/all.css'
import '@mdi/font/css/materialdesignicons.css'
import { aliases, fa } from 'vuetify/iconsets/fa'
import { mdi } from 'vuetify/iconsets/mdi'
/// theme
import { customLight, customDark } from './theme'

const app = createApp(App)
const vuetify = createVuetify({
  icons: {
    defaultSet: 'fa',
    aliases,
    sets: {
      fa,
      mdi,
    },
  },
  theme: {
    defaultTheme: 'customLight',
    themes: {
      customLight,
      customDark,
    },
  },
})
const pinia = createPinia()
pinia.use(createPersistedState())

app.use(router)
app.use(vuetify)
app.use(pinia)
app.mount('#app')
