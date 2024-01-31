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
$routes->post('updateBook', 'Book::updateBook');
$routes->post('deleteBook', 'Book::deleteBook');

// student
$routes->get('fetchStudent', 'Student::fetchStudent');