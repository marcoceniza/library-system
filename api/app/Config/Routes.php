<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// register
$routes->post('login', 'Register::login');
$routes->post('register', 'Register::register');

// book
$routes->get('fetchBook', 'Book::fetchBook');
$routes->get('fetchGenre', 'Book::fetchGenre');
$routes->post('addBook', 'Book::addBook');
$routes->post('borrowBook', 'Book::borrowBook');
$routes->post('returnBook', 'Book::returnBook');
$routes->post('updateBook', 'Book::updateBook');
$routes->post('deleteBook', 'Book::deleteBook');

// student
$routes->get('fetchSingleStudent', 'Student::fetchSingleStudent');
$routes->get('fetchStudent', 'Student::fetchStudent');

// transaction
$routes->get('fetchTransaction', 'Transaction::fetchTransaction');