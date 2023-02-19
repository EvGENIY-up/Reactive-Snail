import './bootstrap';
import { createApp, Vue } from 'vue';

const app = createApp({});

import App from './components/App.vue';
import authToken from '. /authToken';
Vue.prototype.Auth = authToken;
app.component('app-component', App);


app.use(router).mount('#app');
