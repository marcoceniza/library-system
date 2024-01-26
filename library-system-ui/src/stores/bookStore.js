import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';
// import { useCustomStore } from './customStore';

export const useBookStore = defineStore('book', () => {
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const isLoading = ref(false);
//   const customStore = useCustomStore();
  const datas = ref([]);

  const fetchBook = async () => {
    isLoading.value = true;

    const res = await axios.get(apiUrl + '/fetchBook');
    datas.value = res.data.result;
  }

  fetchBook();

  return {
    apiUrl, isLoading, datas
  }
})
