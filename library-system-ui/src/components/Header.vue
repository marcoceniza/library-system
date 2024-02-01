<template>
    <div class="bg-[#e85d5d] py-[12px] h-[60px]">
        <p class="text-[23px] ml-[40px] font-bold text-white">LOGO</p>
        <div class="absolute right-0 top-0 z-1">
            <UserCircleIcon @click="customStore.toggleUser" class="h-[3rem] w-[3rem] text-[#fff] absolute right-[8px] top-[6px] cursor-pointer" />
            <ul v-show="customStore.isShowMenu" class="bg-[#ddd] text-center py-[12px] mt-[60px] w-[145px] max-w-[100%] px-0 rounded-b-[5px]">
                <li class="mb-[12px] border-b border-white pb-[10px] relative"><UserIcon class="h-5 w-5 text-[#555] absolute left-[10px] top-[3px]" /><a class="block cursor-pointer hover:opacity-[0.5] text-[#555] no-underline">Profile</a></li>
                <li class="pb-[3px] relative"><ArrowLeftStartOnRectangleIcon class="h-5 w-5 text-[#555] absolute left-[10px] top-[3px]" /><a @click="logOut" class="block cursor-pointer hover:opacity-[0.5] text-[#555] no-underline">Logout</a></li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { UserCircleIcon, UserIcon, ArrowLeftStartOnRectangleIcon } from '@heroicons/vue/24/solid';
import { useCustomStore } from '@/stores/customStore';
import { useRouter } from 'vue-router';
// import { useRegisterStore } from '@/stores/registerStore';

const customStore = useCustomStore();
// const registerStore = useRegisterStore();
const router = useRouter();

const logOut = () => {
    localStorage.clear();
    customStore.toast('Logout Successfully', 'success');
    router.push('/');
}

</script>