<template>
    <div class="flex justify-center text-center">
        <section class="w-[50%] relative h-screen">
            <div class="absolute left-0 right-0 top-[50%] translate-y-[-50%] w-[400px] max-w-full mx-auto">
                <h2 class="text-[37px] mb-[25px] text-[#555]">Signup <span class="block text-[16px] text-[#999]">To create an account, please provide your data</span></h2>
                <div class="mb-2 relative mx-auto">
                    <UserIcon class="h-5 w-5 text-[#a4a4a4] absolute top-[15px] left-[10px]" />
                    <input type="text" v-model="registerStore.register.name" placeholder="Enter name" class="block w-full border rounded-[30px] py-3 pl-8">
                </div>
                <div class="mb-2 relative mx-auto">
                    <MapIcon class="h-5 w-5 text-[#a4a4a4] absolute top-[15px] left-[10px]" />
                    <input type="text" v-model="registerStore.register.address" placeholder="Enter address" class="block w-full border rounded-[30px] py-3 pl-8">
                </div>
                <div class="mb-2 relative mx-auto">
                    <PhoneIcon class="h-5 w-5 text-[#a4a4a4] absolute top-[15px] left-[10px]" />
                    <input type="text" v-model="registerStore.register.phone_number" placeholder="Enter phone number" class="block w-full border rounded-[30px] py-3 pl-8">
                </div>
                <div class="mb-2 relative mx-auto">
                    <EnvelopeIcon class="h-5 w-5 text-[#a4a4a4] absolute top-[15px] left-[10px]" />
                    <input type="text" v-model="registerStore.register.email" placeholder="Enter email" class="block w-full border rounded-[30px] py-3 pl-8">
                </div>
                <div class="mb-2 relative">
                    <LockClosedIcon class="h-5 w-5 text-[#a4a4a4] absolute top-[15px] left-[10px]" />
                    <input :type="customStore.isShowPass ? 'text' : 'password'" v-model="registerStore.register.password" placeholder="Enter password" class="block w-full border rounded-[30px] py-3 pl-8">
                    <div v-show="registerStore.register.password.length > 0" class="absolute top-[14px] right-[12px]">
                        <EyeIcon v-if="!customStore.isShowPass" @click="customStore.showPassHandler" class="h-5 w-5 text-[#a4a4a4] absolute right-0 cursor-pointer" />
                        <EyeSlashIcon v-else @click="customStore.showPassHandler" class="h-5 w-5 text-[#a4a4a4] absolute right-0 cursor-pointer" />
                    </div>
                </div>
                <button @click="registerStore.registerHandler" :class="{ 'opacity-[0.5]': registerStore.isLoading }" class="block w-full bg-[#ea3a3a] hover:bg-[#c53333] text-white rounded-[30px] p-[12px] text-[20px] mb-2 mt-7" :disabled="registerStore.isLoading">{{ registerStore.isLoading ? 'Signup...' : 'Signup' }}</button>
                <a @click="$router.push('/')" class="text-[#555] underline mt-2 block hover:no-underline cursor-pointer">or Login</a>
            </div>
        </section>
        <section class="w-[50%]">
            <figure><img src="../assets/images/login_img.jpg" alt="library" class="h-screen w-full"></figure>
        </section>
    </div>
</template>

<script setup>
import { EnvelopeIcon, LockClosedIcon, UserIcon, MapIcon, EyeIcon, EyeSlashIcon, PhoneIcon } from '@heroicons/vue/24/solid';
import { useCustomStore } from '@/stores/customStore';
import { useRegisterStore } from '@/stores/registerStore';

const customStore = useCustomStore();
const registerStore = useRegisterStore();

</script>