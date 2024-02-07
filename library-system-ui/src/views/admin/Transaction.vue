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

                <!-- confirm modal -->
                <div v-show="confirmTransaction" class="bg-[rgba(0,0,0,0.5)] fixed z-1 top-0 w-full h-[100vh] left-0 right-0 text-center">
                    <div class="mt-[60px] mx-auto w-[500px] max-w-full bg-[#535353] rounded-[6px] py-[20px] relative">
                        <p class="text-white pb-[20px] text-[20px]">Are you sure you want to complete transaction?</p>
                        <div class="flex justify-center gap-2">
                            <button @click="bookStore.returnBookHandler(getBookID)" :class="{ 'opacity-[0.5]': bookStore.isConfirmLoader }" class="btn btn-danger" :disabled="bookStore.isConfirmLoader">{{ bookStore.isConfirmLoader ? 'Confirm...' : 'Confirm' }}</button>
                            <button @click="confirmTransaction = false" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
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
import { useBookStore } from '@/stores/bookStore';
import { onMounted, ref } from 'vue';
 
DataTable.use(DataTablesCore);

const transactionStore = useTransactionStore();
const customStore = useCustomStore();
const bookStore = useBookStore();
const getBookID = ref();
const confirmTransaction = ref(false);

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
    { data: 'transaction_book_isbn',
        render: (data) => {
            return `
                <div style="display: flex; justify-content: center; gap: 5px;">
                    <button class="btn btn-primary btn-sm" data-action="return" data-row="${data}">Return</button>
                </div>
            `;
        }
    },
];

onMounted(() => {
    document.addEventListener('click', async function(event) {
        let action = event.target.dataset.action;
        let row = event.target.dataset.row;

        if(action === 'return') {
            getBookID.value = row;
            confirmTransaction.value = true;

            console.log(transactionStore.data);
        }
    });
});

</script>

<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
table {text-align: center !important;}
</style>