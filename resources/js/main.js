import App from './App.vue'
import router from './router'

import { createApp } from 'vue'
import '@mdi/font/css/materialdesignicons.css'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
// Notifications
import Notifications from '@kyvg/vue3-notification'

const app = createApp(App)

// vuetify setup
const myCustomLightTheme = {
  dark: false,
  colors: {
    background: '#E0F2F1',
    surface: '#FFFFFF',
    primary: '#00796B',
    'primary-darken-1': '#3700B3',
    secondary: '#03DAC6',
    'secondary-darken-1': '#018786',
    error: '#B00020',
    info: '#2196F3',
    success: '#4CAF50',
    warning: '#FB8C00',
  },
}

const vuetify = createVuetify({
    components,
    directives,
    icons: {
      defaultSet: 'mdi', 
    },
    theme: {
      defaultTheme: 'myCustomLightTheme',
      themes: {
        myCustomLightTheme,
      },
    },
})

app.use(router)
app.use(vuetify)
app.use(Notifications)

app.mount('#app')
