<template>
    <div class="relative">
        <Header />
        <div class="flex">
            <section class="h-[100vh] w-[250px] border border-r-[#e3e3e3]">
                <Sidebar />
            </section>
            <section class="w-full p-5 pt-4">
                <p class="relative pl-6 pb-4"><HomeIcon class="h-4 w-4 text-[#555] absolute left-0 top-[5px]" /> Home &gt; Dashboard</p>
                <div class="flex justify-center mb-4">
                    <section class="bg-[#555] m-[4px] w-[300px] min-h-[150px] leading-[150px] max-w-full text-center text-white rounded-[4px]">
                        <p>Number of Student</p>
                    </section>
                    <section class="bg-[#555] m-[4px] w-[300px] min-h-[150px] leading-[150px] max-w-full text-center text-white rounded-[4px]">
                        <p>Number of Librarian</p>
                    </section>
                    <section class="bg-[#555] m-[4px] w-[300px] min-h-[150px] leading-[150px] max-w-full text-center text-white rounded-[4px]">
                        <p>Number of Books</p>
                    </section>
                    <section class="bg-[#555] m-[4px] w-[300px] min-h-[150px] leading-[150px] max-w-full text-center text-white rounded-[4px]">
                        <p>Book Borrowed</p>
                    </section>
                </div>
                <h3 class="mb-4">Dashboard</h3>
                <DataTable :data="bookStore.datas" :columns="columns" class="display table table-striped">
                    <thead>
                        <tr>
                            <th>Book ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Book Genre</th>
                            <th>Book Published Year</th>
                            <th>Book Copies Available</th>
                            <th>Book Total Copies</th>
                        </tr>
                    </thead>
                </DataTable>
            </section>
        </div>
    </div>
</template>

<script setup>
import { HomeIcon } from '@heroicons/vue/24/solid';
import Header from '@/components/Header.vue';
import Sidebar from '@/components/Sidebar.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
import { useBookStore } from '@/stores/bookStore';
 
DataTable.use(DataTablesCore);

const bookStore = useBookStore();

const columns = [
  { data: 'book_isbn' },
  { data: 'book_title' },
  { data: 'book_author' },
  { data: 'book_genre' },
  { data: 'book_published_year' },
  { data: 'book_copies_available' },
  { data: 'book_total_copies' },
];

</script>

<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
</style>