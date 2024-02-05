import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';

export const useStudentStore = defineStore('student', () => {
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const isLoading = ref(false);
  const data = ref([]);
  const singleStudent = ref([]);

  const fetchStudentHandler = async () => {
    const res = await axios.get(apiUrl + '/fetchStudent');
    data.value = res.data.result;
  }

  fetchStudentHandler();

  const fetchSingleStudentHandler = async () => {
    const res = await axios.get(apiUrl + '/fetchSingleStudent');
    singleStudent.value = res.data.result;
  }

  fetchSingleStudentHandler();

  return {
    apiUrl, isLoading, fetchStudentHandler, data,
    fetchSingleStudentHandler, singleStudent
  }
})
