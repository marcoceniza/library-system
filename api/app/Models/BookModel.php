<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'book';
    protected $allowedFields = ['book_isbn', 'book_title', 'book_author', 'book_genre', 'book_published_year', 'book_copies_available', 'book_total_copies',];

    public function fetchBook() {
        $query = $this->findAll();
        return $query;
    }
}