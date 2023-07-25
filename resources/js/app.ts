import './bootstrap'
import 'vuetify/styles' // Global CSS has to be imported
import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.min.css'
import App from './App.vue'
// Route設定は次に行います
import router from './router'

const app = createApp(App)
const vuetify = createVuetify()

app.use(router)
app.use(vuetify)
app.mount('#app')
