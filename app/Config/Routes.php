<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('auth/sendOtp', 'Auth::sendOtp');
$routes->post('auth/verifyOtp', 'Auth::verifyOtp');
$routes->get('auth/logout', 'Auth::logout');
