<template>
    <div class="bg-[rgba(0,0,0,0.7)] fixed z-1 top-0 w-full h-[100vh] left-0 right-0 text-center">
        <div class="mt-[60px] mx-auto w-[1400px] max-w-full bg-[#ffffff] rounded-[6px] py-[20px] px-[10px] relative">
            <h3 class="pb-[20px]">{{ props.stName }} list of Borrowed Books</h3>
            <span @click="$emit('closeModal')" class="absolute right-[7px] top-[-2px] text-[25px] text-[#555] cursor-pointer hover:opacity-[0.5]">&times;</span>
            
            <DataTable :data="props.data" :columns="columns" class="display table table-striped rounded-[8px]">
                <thead>
                    <tr>
                        <th class="text-center">Book Borrowed</th>
                        <th class="text-center">Book Author</th>
                        <th class="text-center">Book Genre</th>
                        <th class="text-center">Book Published Year</th>
                        <th class="text-center">Borrowed Date</th>
                        <th class="text-center">Return Date</th>
                        <th class="text-center">Approved by</th>
                    </tr>
                </thead>
            </DataTable>

        </div>
    </div>
</template>

<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
import { useCustomStore } from '@/stores/customStore';
 
DataTable.use(DataTablesCore);

const props = defineProps({
    data: Object,
    stName: String
});

const customStore = useCustomStore();

const columns = [
    { data: 'book_title' },
    { data: 'book_author' },
    { data: 'book_genre' },
    { data: 'book_published_year',
        render: (data) => {
            return customStore.formatDate(data);
        }
    },
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
    { data: 'librarian_name' },
];

</script>