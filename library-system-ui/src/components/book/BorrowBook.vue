<template>
    <div class="bg-[rgba(0,0,0,0.5)] fixed z-1 top-0 w-full h-[100vh] left-0 right-0 text-center">
        <div class="mt-[60px] mx-auto w-[600px] max-w-full bg-[#535353] rounded-[6px] py-[20px] relative">
            <h2 class="text-white pb-[20px]">Borrow Book</h2>
            <span @click="$emit('closeModal'); emptyTable()" class="absolute right-[7px] top-[-2px] text-[25px] text-white cursor-pointer hover:opacity-[0.5]">&times;</span>
            <section class="max-w-[350px] mx-auto mb-3">
                <p class="text-left text-white mb-[6px]">Student *</p>
                <select @change="getStudent(selectedStudent)" v-model="selectedStudent" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
                    <option value="">Please select</option>
                    <option v-for="st in studentStore.singleStudent" :key="st.student_id" :value="st.student_name">{{ st.student_name }}</option>
                </select>
            </section>
            <section v-show="studentInfo.length > 0" class="max-w-[550px] mx-auto mb-3">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="st in getStudentInfo" :key="st.student_id">
                            <td>{{ st.student_name }}</td>
                            <td>{{ st.student_address }}</td>
                            <td>{{ st.student_phone_number }}</td>
                            <td>{{ st.student_email }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class="max-w-[350px] mx-auto mb-2">
                <p class="text-left text-white mb-[6px]">Date Borrowed *</p>
                <input type="date" v-model="borrowedDate" placeholder="Author" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
            </section>
            <section class="max-w-[350px] mx-auto mb-2">
                <p class="text-left text-white mb-[6px]">Date Return *</p>
                <input type="date" v-model="returnDate" placeholder="Author" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
            </section>
            <section class="max-w-[350px] mx-auto mb-2">
                <p class="text-left text-white mb-[6px]">Due Date *</p>
                <input type="date" v-model="dueDate" placeholder="Author" class="rounded-[4px] min-h-[40px] py-[8px] px-[12px] w-full">
            </section>
            <section class="max-w-[350px] mx-auto mt-4 mb-4">
                <button @click="bookStore.borrowBookHandler(props.id, studentID, librarian.librarian_id, borrowedDate, returnDate, dueDate)" class="btn btn-primary btn-block w-full">Borrow</button>
            </section>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useStudentStore } from '@/stores/studentStore';
import { useBookStore } from '@/stores/bookStore';

const props = defineProps({
    id: String,
    bookData: Array
});
const studentStore = useStudentStore();
const bookStore = useBookStore();
const studentInfo = ref([]);
const studentID = ref();
const selectedStudent = ref('');
const borrowedDate = ref('');
const returnDate = ref('');
const dueDate = ref('');
const librarian = JSON.parse(localStorage.getItem('librarian_info'));

const getStudent = (student) => {
    studentInfo.value = [];
    studentStore.singleStudent.forEach(res => {
        if(student === res.student_name) {
            studentInfo.value.push(res);
            studentID.value = res.student_id;
        }
    });
}

const getStudentInfo = computed(() => {
    return studentInfo.value;
});

const emptyTable = () => { studentInfo.value = []; selectedStudent.value = ''; }

</script>
