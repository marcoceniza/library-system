import { ref, reactive } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';
import { useCustomStore } from './customStore';

export const useStudentStore = defineStore('student', () => {
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const customStore = useCustomStore();
  const isLoading = ref(false);
  const data = ref([]);

  const fetchStudentHandler = async () => {
    const res = await axios.get(apiUrl + '/fetchStudent');
    data.value = res.data.result;
  }

  fetchStudentHandler();

  return {
    apiUrl, isLoading, fetchStudentHandler, data
  }
})
