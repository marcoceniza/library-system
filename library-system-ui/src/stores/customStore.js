import { ref } from 'vue';
import { defineStore } from 'pinia';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

export const useCustomStore = defineStore('custom', () => {
    const isShowPass = ref(false);
    const $toast = useToast();

    const showPassHandler = () => {
        isShowPass.value = !isShowPass.value;
    }

    const toast = (message, type) => {
        if(type == 'success') $toast.success(message, { position: 'top-right', duration: 4000 });
        else if(type == 'info') $toast.info(message, { position: 'top-right', duration: 4000 });
        else $toast.error(message, { position: 'top-right', duration: 4000 });
    }

    return {
        isShowPass, showPassHandler, toast
    }
})
