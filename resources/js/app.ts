import './bootstrap'
import 'vuetify/styles' // Global CSS has to be imported
import { createApp, markRaw } from 'vue'
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
// plugins
import axios from './plugins/axios'
// lib
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

// atom components
import Text from './components/atoms/Text.vue'
import Button from './components/atoms/Button.vue'
import HelpIcon from './components/HelpIcon.vue'

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
    defaultTheme: 'customDark',
    themes: {
      customLight,
      customDark,
    },
  },
})
const pinia = createPinia()
pinia.use(createPersistedState())
pinia.use(({ store }) => {
  store.router = markRaw(router)
})

app.use(pinia)
app.use(router)
app.use(vuetify)
app.use(axios, {
  baseURL: 'http://localhost/',
  pinia,
})
app.component('VueDatePicker', VueDatePicker)
app.component('SText', Text)
app.component('SBtn', Button)
app.component('HelpIcon', HelpIcon)
app.mount('#app')
