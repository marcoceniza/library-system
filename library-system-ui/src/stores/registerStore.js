import { reactive } from 'vue';
import { defineStore } from 'pinia';
import { useCustomStore } from './customStore';
import axios from 'axios';

export const useRegisterStore = defineStore('register', () => {
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const customStore = useCustomStore();
  const register = reactive({
    name: '',
    address: '',
    phone_number: '',
    email: '',
    password: ''
  });

  const registerHandler = async () => {
    const formData = new FormData();
    formData.append('name', register.name);
    formData.append('address', register.address);
    formData.append('phone_number', register.phone_number);
    formData.append('email', register.email);
    formData.append('password', register.password);

    const res = await axios.post(apiUrl + '/register', formData);
    customStore.toast(res.data.message, res.data.status);

    for (const key in register) register[key] = '';
  }

  return { apiUrl, register, registerHandler }
})
