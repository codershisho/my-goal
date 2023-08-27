import './bootstrap'
import 'vuetify/styles' // Global CSS has to be imported
import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import '@mdi/font/css/materialdesignicons.css'
import App from './App.vue'
// Route設定は次に行います
import router from './router'
// Store設定
import { createPinia } from 'pinia'
import { createPersistedState } from "pinia-plugin-persistedstate";

const app = createApp(App)
const vuetify = createVuetify()
const pinia = createPinia()
pinia.use(createPersistedState());

app.use(router)
app.use(vuetify)
app.use(pinia)
app.mount('#app')
