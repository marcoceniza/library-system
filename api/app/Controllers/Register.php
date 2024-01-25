<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');

use App\Models\RegisterModel;

class Register extends BaseController
{
    public function login() {
        try {
            $model = model(RegisterModel::class);

            $post = $this->request->getPost(['email', 'password']);

            foreach($post as $value) {
                if(empty($value)) throw new \Exception('All fields are required');
            }

            $data = $model->asArray()->where('librarian_email', $post['email'])->first();

            if(!$data) throw new \Exception('Email does not exist');

            if(password_verify($post['password'], $data['librarian_password'])) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Login Successfully'
                ]);
            }else {
                throw new \Exception('Password is Incorrect');
            }

        }catch(\Exception $error) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $error->getMessage()
            ]);
        }
    }

    public function register() {
        try {
            $model = model(RegisterModel::class);

            $post = $this->request->getPost(['name', 'address', 'phone_number', 'email', 'password']);

            foreach($post as $value) {
                if(empty($value)) throw new \Exception('All fields are required');
            }

            $data = [
                'librarian_name' => $post['name'],
                'librarian_address' => $post['address'],
                'librarian_phone_number' => $post['phone_number'],
                'librarian_email' => $post['email'],
                'librarian_password' => password_hash($post['password'], PASSWORD_DEFAULT),
            ];

            if($model->register($data)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Registered Successfully'
                ]);
            }else {
                throw new \Exception('Something went wrong');
            }

        }catch(\Exception $error) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $error->getMessage()
            ]);
        }
    }
}
