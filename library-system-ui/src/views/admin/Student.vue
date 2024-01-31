<template>
    <div class="relative">
        <Header />
        <div class="flex">
            <section class="h-[100vh] w-[250px] border border-r-[#e3e3e3]">
                <Sidebar />
            </section>
            <section class="w-full p-5 pt-4">
                <p class="relative pl-6 pb-4"><HomeIcon class="h-4 w-4 text-[#555] absolute left-0 top-[5px]" /> Home &gt; Student</p>
                <div class="flex justify-between">
                    <h3 class="mb-4">Student</h3>
                </div>
                <DataTable :data="studentStore.data" :columns="columns" class="display table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Student ID</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Student Address</th>
                            <th class="text-center">Student Phone Number</th>
                            <th class="text-center">Student Email</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </DataTable>
            </section>
        </div>
    </div>
</template>

<script setup>
import { HomeIcon, PlusIcon } from '@heroicons/vue/24/solid';
import Header from '@/components/Header.vue';
import Sidebar from '@/components/Sidebar.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
import { useStudentStore } from '@/stores/studentStore';
import { onMounted } from 'vue';
 
DataTable.use(DataTablesCore);

const studentStore = useStudentStore();

const columns = [
    { data: 'student_id' },
    { data: 'student_name' },
    { data: 'student_address' },
    { data: 'student_phone_number' },
    { data: 'student_email' },
    { data: 'student_id',
        render: (data) => {
            return `
                <div style="display: flex; justify-content: center; gap: 5px;">
                    <button class="btn btn-warning btn-sm" data-action="view" data-row="${data}">View</button>
                    <button class="btn btn-warning btn-sm" data-action="edit" data-row="${data}">Edit</button>
                    <button class="btn btn-danger btn-sm" data-action="delete" data-row="${data}">Delete</button>
                </div>
            `;
        }
    },
];

onMounted(() => {
    document.addEventListener('click', async function(event) {
        let action = event.target.dataset.action;
        let row = event.target.dataset.row;

        if(action === 'view') {
            return row;
        }else if(action === 'edit') {
            return true;
        }else if(action === 'delete') {
            return true;
        }
    });
});

</script>

<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
table {text-align: center !important;}
</style>