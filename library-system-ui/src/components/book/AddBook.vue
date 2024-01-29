<template>
    <div class="bg-[rgba(0,0,0,0.5)] fixed z-1 top-0 w-full h-[100vh] left-0 right-0 text-center">
        <div class="mt-[60px] mx-auto w-[500px] max-w-full bg-[#535353] rounded-[6px] py-[20px] relative">
            <h2 class="text-white pb-[20px]">Add Book</h2>
            <span @click="$emit('closeModal')" class="absolute right-[7px] top-[-2px] text-[25px] text-white cursor-pointer hover:opacity-[0.5]">&times;</span>
            <section class="max-w-[350px] mx-auto mb-2">
                <p class="text-left text-white mb-[6px]">Title *</p>
                <input type="text" v-model="bookStore.book.title" placeholder="Title" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
            </section>
            <section class="max-w-[350px] mx-auto mb-2">
                <p class="text-left text-white mb-[6px]">Author *</p>
                <input type="text" v-model="bookStore.book.author" placeholder="Author" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
            </section>
            <section class="max-w-[350px] mx-auto mb-2">
                <p class="text-left text-white mb-[6px]">Genre *</p>
                <select v-model="bookStore.book.genre" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
                    <option value="">Please select</option>
                    <option v-for="genre in bookStore.genre" :key="genre.genre_id" :value="genre.genre_name">{{ genre.genre_name }}</option>
                </select>
            </section>
            <section class="max-w-[350px] mx-auto mb-2">
                <p class="text-left text-white mb-[6px]">Published Year *</p>
                <input type="date" v-model="bookStore.book.publishedYear" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
            </section>
            <section class="max-w-[350px] mx-auto mb-2">
                <p class="text-left text-white mb-[6px]">Copies Available *</p>
                <input type="text" v-model="bookStore.book.copiesAvailable" placeholder="Copies Available" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
            </section>
            <section class="max-w-[350px] mx-auto mb-2">
                <p class="text-left text-white mb-[6px]">Total Copies *</p>
                <input type="text" v-model="bookStore.book.totalCopies" placeholder="Total Copies" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
            </section>
            <section class="max-w-[350px] mx-auto mt-4 mb-4">
                <button @click="bookStore.addBookHandler" :class="{ 'opacity-[0.5]': bookStore.isbookLoader }" class="btn btn-primary btn-block w-full" :disabled="bookStore.isbookLoader">{{ bookStore.isbookLoader ? 'Adding...' : 'Add' }}</button>
            </section>
        </div>
    </div>
</template>

<script setup>
import { useBookStore } from '../../stores/bookStore';

const bookStore = useBookStore();

</script>
