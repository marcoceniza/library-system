<template>
    <div class="relative">
        <Header />
        <div class="flex">
            <section class="h-[100vh] w-[250px] border border-r-[#e3e3e3]">
                <Sidebar />
            </section>
            <section class="w-full p-5 pt-4">
                <p class="relative pl-6 pb-4"><HomeIcon class="h-4 w-4 text-[#555] absolute left-0 top-[5px]" /> Home &gt; Transaction</p>
                <div class="flex justify-between">
                    <h3 class="mb-4">Transaction</h3>
                </div>
                <DataTable :data="transactionStore.data" :columns="columns" class="display table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Borrowed Book</th>
                            <th class="text-center">Borrowed Date</th>
                            <th class="text-center">Return Date</th>
                            <th class="text-center">Due Date</th>
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
import { useTransactionStore } from '@/stores/transactionStore';
import { useCustomStore } from '@/stores/customStore';
import { onMounted } from 'vue';
 
DataTable.use(DataTablesCore);

const transactionStore = useTransactionStore();
const customStore = useCustomStore();

const columns = [
    { data: 'student_name' },
    { data: 'book_title' },
    { data: 'transaction_date_borrowed',
        render: (data) => {
            return customStore.formatDate(data);
        }
    },
    { data: 'transaction_date_returned',
        render: (data) => {
            return customStore.formatDate(data);
        }
    },
    { data: 'transaction_due_date',
        render: (data) => {
            return customStore.formatDate(data);
        }
    },
    { data: 'student_id',
        render: (data) => {
            return `
                <div style="display: flex; justify-content: center; gap: 5px;">
                    <button class="btn btn-primary btn-sm" data-action="view" data-row="${data}">View More</button>
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
            transactionStore.data.forEach(res => {
                if(res.student_id === row) console.log(res);
            }); 
        }
    });
});

</script>

<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
table {text-align: center !important;}
</style>