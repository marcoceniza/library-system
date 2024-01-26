<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $table = 'librarian';
    protected $allowedFields = ['librarian_name', 'librarian_address', 'librarian_phone_number', 'librarian_email', 'librarian_password'];

    public function register($data) {
        $checkEmail = $this->where('librarian_email', $data['librarian_email'])->first();

        if($checkEmail) throw new \Exception('Email already exist');

        $query = $this->insert($data);
        return $query;
    }
}