<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
//$routes->get('/', 'Home::index');
$routes->get('/about', 'Pages::about');
$routes->get('/students', 'Pages::students');
$routes->get('/', 'Pages::index');

$routes->get('/customers', 'CustomerAccounts::index');
$routes->get('/users', 'UserAccounts::index');