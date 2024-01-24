<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $table = 'librarian';
    protected $allowedFields = ['librarian_name', 'librarian_address', 'librarian_phone_number', 'librarian_email', 'librarian_password'];

    public function register($data) {
        $query = $this->insert($data);
        return $query;
    }
}