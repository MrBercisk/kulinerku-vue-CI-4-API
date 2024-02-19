import './assets/main.css'

import { createApp } from 'vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-bootstrap.css';

import App from './App.vue'
import router from './router'

library.add(fas)

const app = createApp(App);
app.use(ToastPlugin);
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(router)
app.mount('#app')
