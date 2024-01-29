<?php

namespace App\Models;

use CodeIgniter\Model;

class GenreModel extends Model
{
    protected $table = 'genre';
    protected $allowedFields = ['genre_name'];

    public function fetchGenre() {
        $query = $this->findAll();
        return $query;
    }
}