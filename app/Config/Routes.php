<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/buku', 'Buku::index');
$routes->get('/buku/tambah', 'Buku::create');
$routes->post('/buku/simpan', 'Buku::store');
$routes->get('/buku/edit/(:num)', 'Buku::edit/$1');
$routes->post('/buku/update/(:num)', 'Buku::update/$1');
$routes->get('/buku/hapus/(:num)', 'Buku::delete/$1');