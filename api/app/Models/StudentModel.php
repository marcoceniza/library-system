<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'transaction';
    protected $allowedFields = ['student_name', 'student_address', 'student_phone_number', 'student_email'];

    public function fetchSingleStudent() {
        $query = $this->db->table('student')
                      ->get();

        return $query->getResult();
    }

    public function fetchStudent() {
        $query = $this->join('book', 'book.book_isbn = transaction.transaction_book_isbn')
                      ->join('student', 'student.student_id = transaction.transaction_student_id')
                      ->join('librarian', 'librarian.librarian_id = transaction.transaction_librarian_id')
                      ->findAll();
                      
        return $query;
    }

    public function addBook($data) {
        $query = $this->insert($data);
        return $query;
    }

    public function updateBook($id, $data) {
        $query = $this->db->table('book')
                      ->where('book_isbn', $id)
                      ->update($data);
        return $query;
    }

    public function deleteBook($id) {
        $query = $this->where('book_isbn', $id)
                      ->delete();
        return $query;
    }
}