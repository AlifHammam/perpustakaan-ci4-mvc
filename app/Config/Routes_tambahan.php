<?php
/**
 * ============================================================
 * ROUTING MANUAL - Modul Buku
 * ------------------------------------------------------------
 * Tempelkan blok ini ke dalam file app/Config/Routes.php
 * (di bawah baris $routes->get('/', 'Home::index'); yang sudah ada bawaan CI4)
 * ============================================================
 */

$routes->get('/buku', 'Buku::index');
$routes->get('/buku/tambah', 'Buku::create');
$routes->post('/buku/simpan', 'Buku::store');
$routes->get('/buku/edit/(:num)', 'Buku::edit/$1');
$routes->post('/buku/update/(:num)', 'Buku::update/$1');
$routes->get('/buku/hapus/(:num)', 'Buku::delete/$1');
