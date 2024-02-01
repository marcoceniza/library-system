<template>
    <ul class="max-w-[100%] rounded-b-[5px] w-full p-0">
        <li class="border-b border-white relative"><HomeIcon class="h-5 w-5 text-[#555 absolute top-[17px] left-[12px]" /><a :class="{ 'bg-[#ececec]': customStore.isRoute('/dashboard') }" @click="$router.push('/dashboard')" class="block py-[15px] cursor-pointer hover:opacity-[0.5] pl-[42px] no-underline text-[#555]">Dashboard</a></li>
        <li class="pb-[3px] relative"><AcademicCapIcon class="h-5 w-5 text-[#555] absolute top-[17px] left-[12px]" /><a :class="{ 'bg-[#ececec]': customStore.isRoute('/student') }" @click="$router.push('/student')" class="block py-[15px] cursor-pointer hover:opacity-[0.5] pl-[42px] no-underline text-[#555]">Student</a></li>
    </ul>
</template>

<script setup>
import { HomeIcon, AcademicCapIcon } from '@heroicons/vue/24/solid';
import { useCustomStore } from '@/stores/customStore';

const customStore = useCustomStore();

</script>