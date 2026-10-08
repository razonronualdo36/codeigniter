<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
//$routes->get('/', 'Home::index');
$routes->get('/about', 'Pages::about');
$routes->get('/students', 'Pages::students');
$routes->get('/', 'Pages::index');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');

$routes->group('', ['filter' => 'auth'], static function ($routes): void {
    $routes->post('/logout', 'Auth::logout');

    $routes->get('/customers', 'CustomerAccounts::index');
    $routes->get('/customers/new', 'CustomerAccounts::new');
    $routes->post('/customers', 'CustomerAccounts::create');
    $routes->get('/customers/(:num)/edit', 'CustomerAccounts::edit/$1');
    $routes->post('/customers/(:num)', 'CustomerAccounts::update/$1');

    $routes->get('/users', 'UserAccounts::index');
    $routes->get('/users/new', 'UserAccounts::new');
    $routes->post('/users', 'UserAccounts::create');
    $routes->get('/users/(:num)/edit', 'UserAccounts::edit/$1');
    $routes->post('/users/(:num)', 'UserAccounts::update/$1');
});
