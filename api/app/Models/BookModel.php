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

    public function borrowBook($data) {
        $book = $this->findAll();

        foreach($book as $value) {
            if($value['book_isbn'] == $data['transaction_book_isbn']) {
                $bookCount = $value['book_copies_available'] - 1;

                $totalBook = $this->db->table('book')
                                      ->where('book_isbn', $data['transaction_book_isbn'])
                                      ->update(['book_copies_available' => $bookCount]);
                
                if($totalBook) {
                    $query = $this->db->table('transaction')
                                      ->insert($data);

                    return $query;
                }
            }
        }
    }

    public function returnBook($bookID) {
        $book = $this->findAll();

        foreach($book as $value) {
            if($value['book_isbn'] == $bookID) {
                $bookCount = $value['book_copies_available'] + 1;

                $totalBook = $this->db->table('book')
                                      ->where('book_isbn', $bookID)
                                      ->update(['book_copies_available' => $bookCount]);

                if($totalBook) {
                    $this->db->table('transaction')
                             ->where('transaction_id', $bookID)
                             ->update(['transaction_status' => 1]);

                    return true;
                }
            }
        }
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