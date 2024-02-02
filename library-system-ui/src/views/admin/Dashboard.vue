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
                <div class="flex justify-between">
                    <h3 class="mb-4">Dashboard</h3>
                    <button @click="bookStore.showBookModal" class="btn btn-primary relative h-[50px] w-[120px] max-w-full"><PlusIcon class="h-4 w-4 text-[#fff] absolute top-[18px]" /> Book</button>
                </div>
                <DataTable :data="bookStore.data" :columns="columns" class="display table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Book ISBN</th>
                            <th class="text-center">Book Title</th>
                            <th class="text-center">Book Author</th>
                            <th class="text-center">Book Genre</th>
                            <th class="text-center">Book Published Year</th>
                            <th class="text-center">Book Copies Available</th>
                            <th class="text-center">Book Total Copies</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                </DataTable>

                <!-- add book -->
                <AddBook @closeModal="bookStore.showBookModal" v-show="bookStore.isShowBookModal" />

                <!-- update book -->
                <editBook @closeModal="bookStore.showeditBookModal" :isbn="isbn" v-show="bookStore.isShoweditBookModal" />

                <!-- delete book -->
                <div v-show="bookStore.isShowDeleteBookModal" class="bg-[rgba(0,0,0,0.5)] fixed z-1 top-0 w-full h-[100vh] left-0 right-0 text-center">
                    <div class="mt-[60px] mx-auto w-[500px] max-w-full bg-[#535353] rounded-[6px] py-[20px] relative">
                        <p class="text-white pb-[20px] text-[20px]">Are you sure you want to delete?</p>
                        <div class="flex justify-center gap-2">
                            <button @click="bookStore.deleteBookHandler(id)" :class="{ 'opacity-[0.5]': bookStore.isbookLoader }" class="btn btn-danger" :disabled="bookStore.isbookLoader">{{ bookStore.isbookLoader ? 'Deleting...' : 'Delete' }}</button>
                            <button @click="bookStore.isShowDeleteBookModal = false" class="btn btn-secondary">Cancel</button>
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
import AddBook from '../../components/book/AddBook.vue';
import editBook from '../../components/book/EditBook.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
import { useBookStore } from '@/stores/bookStore';
import { useCustomStore } from '@/stores/customStore';
import { onMounted, ref } from 'vue';
 
DataTable.use(DataTablesCore);

const bookStore = useBookStore();
const customStore = useCustomStore();
const isbn = ref('');
const id = ref('');

const columns = [
    { data: 'book_isbn' },
    { data: 'book_title' },
    { data: 'book_author' },
    { data: 'book_genre' },
    { data: 'book_published_year' ,
        render: (data) => {
            return customStore.formatDate(data);
        }
    },
    { data: 'book_copies_available' },
    { data: 'book_total_copies' },
    { data: 'book_isbn',
        render: (data) => {
            return `
                <div style="display: flex; justify-content: center; gap: 5px;">
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

        if(action === 'edit') {
            bookStore.data.forEach(res => {
                if(res.book_isbn === row) {
                    isbn.value = res.book_isbn;
                    bookStore.editBook.title = res.book_title;
                    bookStore.editBook.author = res.book_author;
                    bookStore.editBook.genre = res.book_genre;
                    bookStore.editBook.publishedYear = customStore.formatDate(res.book_published_year);
                    bookStore.editBook.copiesAvailable = res.book_copies_available;
                    bookStore.editBook.totalCopies = res.book_total_copies;
                }
            });

            bookStore.isShoweditBookModal = true;
        }else if(action === 'delete') {
            id.value = row;
            bookStore.isShowDeleteBookModal = true;
        }
    });
});

</script>

<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
table {text-align: center !important;}
</style>