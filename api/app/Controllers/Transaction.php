<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');

use App\Models\TransactionModel;

class Transaction extends BaseController
{
    public function fetchTransaction() {
        try {
            $model = model(TransactionModel::class);

            $result = $model->fetchTransaction();

            if($result) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Fetch Successfully',
                    'result' => $result
                ]);
            }else {
                throw new \Exception('No Data Found');
            }

        }catch(\Exception $error) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $error->getMessage()
            ]);
        }
    }
}
