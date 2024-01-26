<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');

use App\Models\BookModel;

class Book extends BaseController
{
    public function fetchBook() {
        try {
            $model = model(BookModel::class);

            $result = $model->fetchBook();

            if($model->fetchBook()) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Fetch Successfully',
                    'result' => $result
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
