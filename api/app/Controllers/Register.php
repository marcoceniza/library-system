<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');

use App\Models\RegisterModel;

class Register extends BaseController
{
    // protected $registerModel;

    // public function __construct() {
    //     parent::__construct();
    //     $this->registerModel = new RegisterModel();
    // }

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
