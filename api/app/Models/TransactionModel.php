<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $allowedFields = ['student_name', 'student_address', 'student_phone_number', 'student_email'];

    public function fetchTransaction() {
        $query = $this->join('book', 'book.book_isbn = transaction.transaction_book_isbn')
                      ->join('student', 'student.student_id = transaction.transaction_student_id')
                      ->join('librarian', 'librarian.librarian_id = transaction.transaction_librarian_id')
                      ->findAll();

        return $query;
    }
}