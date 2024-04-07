import './bootstrap';

import {createApp} from "vue";
import ChatMessages from "./components/ChatMessages.vue";
import ChatForm from "./components/ChatForm.vue";

const app = createApp({
    components: {
        ChatMessages,
        ChatForm,
    }
})

app.mount('#app')
