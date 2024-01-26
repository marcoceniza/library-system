<template>
    <ul class="max-w-[100%] rounded-b-[5px] w-full">
        <li class="border-b border-white relative"><HomeIcon class="h-5 w-5 text-[#555 absolute top-[17px] left-[12px]" /><a class="block py-[15px] cursor-pointer hover:opacity-[0.5] pl-[42px]">Dashboard</a></li>
        <li class="pb-[3px] relative"><AcademicCapIcon class="h-5 w-5 text-[#555] absolute top-[17px] left-[12px]" /><a class="block py-[15px] cursor-pointer hover:opacity-[0.5] pl-[42px]">Student</a></li>
    </ul>
</template>

<script setup>
import { HomeIcon, AcademicCapIcon } from '@heroicons/vue/24/solid';
// import { useCustomStore } from '@/stores/customStore';
// import { useRegisterStore } from '@/stores/registerStore';

// const customStore = useCustomStore();
// const registerStore = useRegisterStore();

</script>