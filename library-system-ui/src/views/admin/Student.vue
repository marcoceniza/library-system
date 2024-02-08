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
                <DataTable :data="studentStore.singleStudent" :columns="columns" class="display table table-striped">
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

                <!-- view student -->
                <ViewStudent @closeModal="viewTransactionModal" v-show="showViewTrasactionModal" :data="studentInfo" :stName="studentName" />

                <!-- delete student transaction -->
                <!-- <div class="bg-[rgba(0,0,0,0.5)] fixed z-1 top-0 w-full h-[100vh] left-0 right-0 text-center">
                    <div class="mt-[60px] mx-auto w-[500px] max-w-full bg-[#535353] rounded-[6px] py-[20px] relative">
                        <p class="text-white pb-[20px] text-[20px]">Are you sure you want to delete?</p>
                        <div class="flex justify-center gap-2">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div> -->
            </section>
        </div>
    </div>
</template>

<script setup>
import { HomeIcon, PlusIcon } from '@heroicons/vue/24/solid';
import Header from '@/components/Header.vue';
import Sidebar from '@/components/Sidebar.vue';
import ViewStudent from '@/components/student/ViewStudent.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
import { useStudentStore } from '@/stores/studentStore';
import { onMounted, ref } from 'vue';
 
DataTable.use(DataTablesCore);

const studentStore = useStudentStore();
const showViewTrasactionModal = ref(false);
const studentInfo = ref([]);
const studentName = ref('');

const viewTransactionModal = () => {
    showViewTrasactionModal.value = !showViewTrasactionModal.value;
}

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
                    <button class="btn btn-primary btn-sm" data-action="view" data-row="${data}">View</button>
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
            studentInfo.value = [];
            studentName.value = '';
            
            studentStore.singleStudent.forEach(el => {
                if(el.student_id === row) {
                    studentName.value = el.student_name;

                    studentStore.data.forEach(el2 => {
                        if(el.student_id == el2.student_id) {
                            studentInfo.value.push(el2);
                            console.log(el2);
                        }
                    });
                }
            });

            showViewTrasactionModal.value = true;
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