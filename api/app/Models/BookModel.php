<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'book';
    protected $allowedFields = ['book_isbn', 'book_title', 'book_author', 'book_genre', 'book_published_year', 'book_copies_available', 'book_total_copies'];

    public function fetchBook() {
        $query = $this->findAll();
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