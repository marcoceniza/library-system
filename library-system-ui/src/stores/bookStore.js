import { ref, reactive } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';
import { useCustomStore } from './customStore';

export const useBookStore = defineStore('book', () => {
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const customStore = useCustomStore();
  const isLoading = ref(false);
  const isbookLoader = ref(false);
  const isBorrowLoader = ref(false);
  const isShowBookModal = ref(false);
  const isShowBorrowBookModal = ref(false);
  const isShowUpdateBookModal = ref(false);
  const isShowDeleteBookModal = ref(false);
  const data = ref([]);
  const genre = ref([]);
  const book = reactive({
    title: '',
    author: '',
    genre: '',
    publishedYear: '',
    copiesAvailable: '',
    totalCopies: ''
  });
  const updateBook = reactive({
    title: '',
    author: '',
    genre: '',
    publishedYear: '',
    copiesAvailable: '',
    totalCopies: ''
  });

  const showBookModal = () => {
    isShowBookModal.value = !isShowBookModal.value;
  }

  const showUpdateBookModal = () => {
      isShowUpdateBookModal.value = !isShowUpdateBookModal.value;
  }

  const showBorrowBookModal = () => {
    isShowBorrowBookModal.value = !isShowBorrowBookModal.value;
  }

  const fetchBookHandler = async () => {
    const res = await axios.get(apiUrl + '/fetchBook');
    data.value = res.data.result;
  }

  fetchBookHandler();

  const fetchGenreHandler = async () => {
    const res = await axios.get(apiUrl + '/fetchGenre');
    genre.value = res.data.result;
  }

  fetchGenreHandler();

  const addBookHandler = async () => {
    isbookLoader.value = true;

    const formData = new FormData();
    formData.append('title', book.title);
    formData.append('author', book.author);
    formData.append('genre', book.genre);
    formData.append('publishedYear', book.publishedYear);
    formData.append('copiesAvailable', book.copiesAvailable);
    formData.append('totalCopies', book.totalCopies);

    const res = await axios.post(apiUrl + '/addBook', formData);
    customStore.toast(res.data.message, res.data.status);
    if(res.data.status === 'error') return isbookLoader.value = false;

    for(const key in book) book[key] = '';
    isbookLoader.value = false;
    isShowBookModal.value = false;
    fetchBookHandler();
  }

  const borrowBookHandler = async (bookID, studentID, librarianID, borrowedDate, returnDate, dueDate) => {
    isBorrowLoader.value = true;

    const formData = new FormData();
    formData.append('bookID', bookID);
    formData.append('studentID', studentID);
    formData.append('librarianID', librarianID);
    formData.append('borrowedDate', borrowedDate);
    formData.append('returnDate', returnDate);
    formData.append('dueDate', dueDate);

    const res = await axios.post(apiUrl + '/borrowBook', formData);
    customStore.toast(res.data.message, res.data.status);
    if(res.data.status === 'error') return isBorrowLoader.value = false;

    isBorrowLoader.value = false;
    isShowBorrowBookModal.value = false;
  }

  const updateBookHandler = async (isbn) => {
    isbookLoader.value = true;

    const formData = new FormData();
    formData.append('isbn', isbn);
    formData.append('title', updateBook.title);
    formData.append('author', updateBook.author);
    formData.append('genre', updateBook.genre);
    formData.append('publishedYear', updateBook.publishedYear);
    formData.append('copiesAvailable', updateBook.copiesAvailable);
    formData.append('totalCopies', updateBook.totalCopies);

    const res = await axios.post(apiUrl + '/updateBook', formData);
    customStore.toast(res.data.message, res.data.status);
    if(res.data.status === 'error') return isbookLoader.value = false;

    isbookLoader.value = false;
    isShowUpdateBookModal.value = false;
    fetchBookHandler();
  }

  const deleteBookHandler = async (id) => {
    isbookLoader.value = true;

    const formData = new FormData();
    formData.append('id', id);

    const res = await axios.post(apiUrl + '/deleteBook', formData);
    customStore.toast(res.data.message, res.data.status);
    if(res.data.status === 'error') return isbookLoader.value = false;

    isbookLoader.value = false;
    isShowDeleteBookModal.value = false;
    fetchBookHandler();
  }

  return {
    apiUrl, isLoading, data, addBookHandler,
    isbookLoader, book, genre, updateBookHandler,
    updateBook, deleteBookHandler, isShowBookModal, isShowUpdateBookModal,
    isShowDeleteBookModal, showBookModal, showUpdateBookModal, isShowBorrowBookModal,
    showBorrowBookModal, borrowBookHandler
  }
})
