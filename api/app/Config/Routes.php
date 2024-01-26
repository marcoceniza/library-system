<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// register
$routes->post('login', 'Register::login');
$routes->post('register', 'Register::register');

// book
$routes->get('fetchBook', 'Book::fetchBook');