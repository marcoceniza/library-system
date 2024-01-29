<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');

use App\Models\BookModel;
use App\Models\GenreModel;

class Book extends BaseController
{
    public function fetchBook() {
        try {
            $model = model(BookModel::class);

            $result = $model->fetchBook();

            if($result) {
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

    public function fetchGenre() {
        try {
            $model = model(GenreModel::class);

            $result = $model->fetchGenre();

            if($result) {
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

    public function addBook() {
        try {
            $model = model(BookModel::class);
            $post = $this->request->getPost(['title', 'author', 'genre', 'publishedYear', 'copiesAvailable', 'totalCopies']);

            foreach($post as $value) {
                if(empty($value)) throw new \Exception('All fields are required');
            }

            $data = [
                'book_title' => $post['title'],
                'book_author' => $post['author'],
                'book_genre' => $post['genre'],
                'book_published_year' => $post['publishedYear'],
                'book_copies_available' => $post['copiesAvailable'],
                'book_total_copies' => $post['totalCopies']
            ];

            if($model->addBook($data)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Added Successfully'
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

    public function updateBook() {
        try {
            $model = model(BookModel::class);
            $post = $this->request->getPost(['isbn', 'title', 'author', 'genre', 'publishedYear', 'copiesAvailable', 'totalCopies']);

            foreach($post as $value) {
                if(empty($value)) throw new \Exception('All fields are required');
            }

            $data = [
                'book_title' => $post['title'],
                'book_author' => $post['author'],
                'book_genre' => $post['genre'],
                'book_published_year' => $post['publishedYear'],
                'book_copies_available' => $post['copiesAvailable'],
                'book_total_copies' => $post['totalCopies']
            ];

            if($model->updateBook($post['isbn'], $data)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Updated Successfully'
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

    public function deleteBook() {
        try {
            $model = model(BookModel::class);
            $post = $this->request->getPost(['id']);

            if($model->deleteBook($post['id'])) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Deleted Successfully'
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
