import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';

export const useTransactionStore = defineStore('transaction', () => {
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const isLoading = ref(false);
  const data = ref([]);

  const fetchTransactionHandler = async () => {
    const res = await axios.get(apiUrl + '/fetchTransaction');
    data.value = res.data.result;
  }

  fetchTransactionHandler();

  return {
    apiUrl, isLoading, fetchTransactionHandler, data
  }
})
