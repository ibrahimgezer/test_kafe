<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Sunucunuzda session.gc_probability = 0 yapın (php.ini).

$routes->setAutoRoute(true);

$routes->group('auth', function ($routes) {

    $routes->get('/', 'AuthController::index');

    $routes->get('login', 'AuthController::login');

    $routes->get('logout', 'AuthController::logout');

});

$routes->get('/', 'HomeController::index');

$routes->get('_qrmenu/(:any)', 'QrMenuController::index/$1');

$routes->group('_products', function ($routes) {

    $routes->get('(:any)', 'QrMenuController::products/$1');

    $routes->get('search', 'QrMenuController::search');

});

$routes->get('sepet', 'CartController::index');

$routes->group('cart', function ($routes) {

    $routes->post('add', 'CartController::add');

    $routes->post('update', 'CartController::update');

    $routes->post('remove', 'CartController::remove');

    $routes->post('clear', 'CartController::clear');

});

$routes->get('siparislerim', 'OrderController::index');

$routes->group('order', function ($routes) {

    $routes->post('create', 'OrderController::createOrder');

    $routes->get('status/(:num)', 'OrderController::status/$1');

});

$routes->get('/2/(:any)', 'QrMenuController::index2/$1');


