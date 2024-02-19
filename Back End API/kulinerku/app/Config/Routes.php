<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/* Product API */
$routes->group('api', ['filter' => 'cors'], function ($routes) {
    $routes->get('products', 'Products::index');
    $routes->get('products/(:segment)', 'Products::show/$1');
    $routes->post('products', 'Products::create');
    $routes->put('products/(:segment)', 'Products::update/$1');
    $routes->delete('products/(:segment)', 'Products::delete/$1');

    /* Register & login */

    $routes->get('user', 'User::index');
    $routes->get('user/(:segment)', 'User::show/$1');
    $routes->delete('user/(:segment)', 'User::delete/$1');
    $routes->put('user/(:segment)', 'User::update/$1');
    $routes->post('user', 'User::create');

    /* Pesanan */
    $routes->get('pesanan', 'Pesanan::index');
    $routes->get('pesanan/(:segment)', 'Pesanan::show/$1');
    $routes->delete('pesanan/(:segment)', 'Pesanan::delete/$1');
    $routes->put('pesanan/(:segment)', 'Pesanan::update/$1');
    $routes->post('pesanan', 'Pesanan::create');
});
$routes->options('(:any)', 'Preflight::options');