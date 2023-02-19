import './bootstrap';
import { createApp } from 'vue';
import router from './index';

const app = createApp({});

import App from './components/App.vue';
import Auth from './authToken.js';
app.provide('$Auth',Auth);
app.component('app-component', App);


app.use(router).mount('#app');
