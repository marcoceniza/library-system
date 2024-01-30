import { reactive, ref } from 'vue';
import { defineStore } from 'pinia';
import { useCustomStore } from './customStore';
import axios from 'axios';
import { useRouter } from 'vue-router';

export const useRegisterStore = defineStore('register', () => {
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const customStore = useCustomStore();
  const isLoading = ref(false);
  const login = reactive({ email: '', password: '' });
  const router = useRouter();
  const register = reactive({
    name: '',
    address: '',
    phone_number: '',
    email: '',
    password: ''
  });

  const loginHandler = async () => {
    isLoading.value = true;

    const formData = new FormData();
    formData.append('email', login.email);
    formData.append('password', login.password);

    const res = await axios.post(apiUrl + '/login', formData);
    customStore.toast(res.data.message, res.data.status);
    if(res.data.status === 'error') return isLoading.value = false;
    localStorage.setItem('user_info', JSON.stringify(res.data.result));
    router.push('/dashboard');

    for (const key in login) login[key] = '';
    isLoading.value = false;
  }

  const registerHandler = async () => {
    isLoading.value = true;

    const formData = new FormData();
    formData.append('name', register.name);
    formData.append('address', register.address);
    formData.append('phone_number', register.phone_number);
    formData.append('email', register.email);
    formData.append('password', register.password);

    const res = await axios.post(apiUrl + '/register', formData);
    customStore.toast(res.data.message, res.data.status);
    if(res.data.status === 'error') return isLoading.value = false;

    for (const key in register) register[key] = '';
    isLoading.value = false;
  }

  return {
    apiUrl, register, registerHandler, loginHandler,
    login, isLoading, router
  }
})
