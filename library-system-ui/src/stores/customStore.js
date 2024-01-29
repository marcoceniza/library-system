import { ref } from 'vue';
import { defineStore } from 'pinia';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import { useRoute } from 'vue-router';

export const useCustomStore = defineStore('custom', () => {
    const isShowPass = ref(false);
    const isShowMenu = ref(false);
    const $toast = useToast();
    const route = useRoute();

    const showPassHandler = () => {
        isShowPass.value = !isShowPass.value;
    }

    const toast = (message, type) => {
        if(type == 'success') $toast.success(message, { position: 'top-right', duration: 4000 });
        else if(type == 'info') $toast.info(message, { position: 'top-right', duration: 4000 });
        else $toast.error(message, { position: 'top-right', duration: 4000 });
    }

    const toggleUser = () => {
        isShowMenu.value = !isShowMenu.value
    }

    const isRoute = (path) => {
        return route.path === path;
    };

    const formatDate = (inputDate) => {
        const months = [
          "January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"
        ];
      
        const date = new Date(inputDate);
        const monthName = months[date.getMonth()];
        const day = date.getDate();
        const year = date.getFullYear();
      
        const formattedDate = `${monthName} ${day}, ${year}`;
        return formattedDate;
    }

    return {
        isShowPass, showPassHandler, toast, isShowMenu,
        toggleUser, isRoute, formatDate
    }
})
