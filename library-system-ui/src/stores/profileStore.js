import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useProfileStore = defineStore('profile', () => {
    const librarian = ref(JSON.parse(localStorage.getItem('librarian_info')));

    return {
        librarian
    }
})
