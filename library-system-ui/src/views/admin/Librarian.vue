<template>
    <div class="relative">
        <Header />
        <div class="flex">
            <section class="h-[100vh] w-[250px] border border-r-[#e3e3e3]">
                <Sidebar />
            </section>
            <section class="w-full p-5 pt-4">
                <p class="relative pl-6 pb-4"><HomeIcon class="h-4 w-4 text-[#555] absolute left-0 top-[5px]" /> Home &gt; Librarian</p>
                <h3 class="mb-4">Librarian</h3>
                <DataTable :data="data" class="display table table-striped">
                    <thead>
                        <tr>
                            <th>A</th>
                            <th>B</th>
                        </tr>
                    </thead>
                </DataTable>
            </section>
        </div>
    </div>
</template>

<script setup>
import Header from '@/components/Header.vue';
import Sidebar from '@/components/Sidebar.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
 
DataTable.use(DataTablesCore);
import { HomeIcon } from '@heroicons/vue/24/solid';
// import { useCustomStore } from '@/stores/customStore';
// import { useRegisterStore } from '@/stores/registerStore';

// const customStore = useCustomStore();
// const registerStore = useRegisterStore();

const data = [
  [1, 2],
  [3, 4],
];

</script>

<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
</style>