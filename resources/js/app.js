import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler';
import ClientChat from './components/client/chat/Index.vue';

const app = createApp({
    components: {
        'ClientChat': ClientChat,
    },
},);
app.mount('#app');