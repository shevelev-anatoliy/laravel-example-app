import './bootstrap';

import {createApp} from "vue";
import ChatMessages from "./components/ChatMessages.vue";
import ChatForm from "./components/ChatForm.vue";

const app = createApp({
    components: {
        ChatMessages,
        ChatForm,
    }
});

app.mount('#app');

// import Swiper JS
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
// import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    modules: [Navigation, Pagination],

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
});
