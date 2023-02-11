import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler.js'
import Table from './components/Table.vue'
import Alert from './components/Alert.vue'

const app = createApp({})
app.component('user-table', Table);
// app.component('alert', Alert);
app.mount('#app')