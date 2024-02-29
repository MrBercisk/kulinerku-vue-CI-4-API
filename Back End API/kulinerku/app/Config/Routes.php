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

    $routes->resource('products');
    $routes->resource('user');
    $routes->resource('keranjang');

    /* Best foods */
    $routes->get('bestfoods', 'BestFoods::index');
    $routes->post('bestfoods', 'BestFoods::create');

    $routes->get('login', 'Login::index');
    $routes->get('login/(:segment)', 'Login::show/$1');
    $routes->post('login', 'Login::create');

    $routes->get('pesanan', 'Pesanan::index');
    $routes->get('pesanan/(:segment)', 'Pesanan::show/$1');
    $routes->post('pesanan', 'Pesanan::create');

});
$routes->options('(:any)', 'Preflight::options');
