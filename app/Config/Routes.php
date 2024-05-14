<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/landing', 'Home::landing');

$routes->get('session-check', 'AuthController::session_check');

$routes->get('process-logout/(:any)', 'AuthController::logout/$1');

$routes->group('login', static function ($routes) {
    $routes->get('admin', 'AuthController::index');
    $routes->get('pendaftaran', 'AuthController::pendaftaran');
    $routes->get('sampling', 'AuthController::sampling');
    $routes->get('pemeriksaan', 'AuthController::pemeriksaan');
    $routes->get('validasi', 'AuthController::validasi');
    $routes->post('process-login/(:any)', 'AuthController::login/$1');
});

$routes->group('admin', static function ($routes) {
    $routes->get('/', 'Home::admin');

    //routing user page
    $routes->get('users', 'AdminController::indexUser');
    $routes->get('users-list', 'AdminController::userList');
    $routes->get('users/create-user', 'AdminController::createUser');
    $routes->post('users/store-user', 'AdminController::storeUser');
    $routes->get('users/edit-user/(:any)', 'AdminController::editItemPemeriksaan/$1');
    $routes->post('users/update-user/(:any)', 'AdminController::updateUser/$1');

    //routing item pemeriksaan page
    $routes->get('item-pemeriksaan', 'AdminController::indexItemPemeriksaan');
    $routes->get('item-pemeriksaan-list', 'AdminController::itemPemeriksaanList');
    $routes->get('item-pemeriksaan/create-item', 'AdminController::createItemPemeriksaan');
    $routes->post('item-pemeriksaan/store-item', 'AdminController::storeItemPemeriksaan');
});

$routes->group('pendaftaran', static function ($routes) {
    $routes->get('/', 'Home::pendaftaran');

    //routing registrasi page
    $routes->get('registrasi', 'PendaftaranController::indexRegistrasi');
    $routes->post('set-registrasi', 'PendaftaranController::setRegistrasi');
    $routes->get('jenis-pemeriksaan', 'PendaftaranController::jenisPemeriksaan');
    $routes->get('jenis-pemeriksaan/(:any)', 'PendaftaranController::subJenisPemeriksaan/$1');
    $routes->get('sub-jenis-pemeriksaan/(:any)', 'PendaftaranController::showSubJenisPemeriksaan/$1');
    $routes->get('rincian-pemeriksaan', 'PendaftaranController::rincianItemPemeriksaan');
});

$routes->group('sampling', static function ($routes) {
    $routes->get('/', 'Home::sampling');
});

$routes->group('pemeriksaan', static function ($routes) {
    $routes->get('/', 'Home::pemeriksaan');
});

$routes->group('validasi', static function ($routes) {
    $routes->get('/', 'Home::validasi');
});
