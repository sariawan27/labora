<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/landing', 'Home::landing');
$routes->get('/notification', 'Home::notification');

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
    $routes->post('users/delete-user', 'AdminController::deleteUser');

    //routing item pemeriksaan page
    $routes->get('item-pemeriksaan', 'AdminController::indexItemPemeriksaan');
    $routes->get('item-pemeriksaan-list', 'AdminController::itemPemeriksaanList');
    $routes->get('item-pemeriksaan/create-item', 'AdminController::createItemPemeriksaan');
    $routes->post('item-pemeriksaan/store-item', 'AdminController::storeItemPemeriksaan');
    $routes->get('item-pemeriksaan/show-item/(:any)', 'AdminController::showItemPemeriksaan/$1');
    $routes->post('item-pemeriksaan/update-item/(:any)', 'AdminController::updateItemPemeriksaan/$1');
    $routes->post('item-pemeriksaan/delete-item', 'AdminController::deleteItemPemeriksaan');

    //routing sub item pemeriksaan page
    $routes->get('sub-item-pemeriksaan-list/(:any)', 'AdminController::subItemPemeriksaanList/$1');
    $routes->get('sub-item-pemeriksaan/create-sub-item/(:any)', 'AdminController::createSubItemPemeriksaan/$1');
    $routes->post('sub-item-pemeriksaan/store-sub-item/(:any)', 'AdminController::storeSubItemPemeriksaan/$1');
    $routes->get('sub-item-pemeriksaan/edit-sub-item/(:any)', 'AdminController::editSubItemPemeriksaan/$1');
    $routes->post('sub-item-pemeriksaan/update-sub-item/(:any)', 'AdminController::updateSubItemPemeriksaan/$1');
    $routes->post('sub-item-pemeriksaan/delete-sub-item', 'AdminController::deleteSubItemPemeriksaan');

    $routes->get('pendaftar', 'AdminController::indexPendaftar');
    $routes->get('pendaftar-list', 'AdminController::pemeriksaanList');
    $routes->post('pendaftar/update-pembayaran/(:any)', 'AdminController::konfirmasiPembayaran/$1');
});

$routes->group('pendaftaran', static function ($routes) {
    $routes->get('/', 'Home::pendaftaran');

    //routing registrasi page
    $routes->get('registrasi', 'PendaftaranController::indexRegistrasi');
    $routes->post('set-registrasi', 'PendaftaranController::setRegistrasi');
    $routes->get('jenis-pemeriksaan', 'PendaftaranController::jenisPemeriksaan');
    $routes->get('jenis-pemeriksaan/(:any)', 'PendaftaranController::subJenisPemeriksaan/$1');
    $routes->get('sub-jenis-pemeriksaan/(:any)', 'PendaftaranController::showSubJenisPemeriksaan/$1');
    $routes->get('temp-sub/(:any)', 'PendaftaranController::tempPemeriksaan/$1');
    $routes->get('del-jenis-pemeriksaan/(:any)', 'PendaftaranController::delItemTempPemeriksaan/$1');
    $routes->get('rincian-pemeriksaan', 'PendaftaranController::rincianItemPemeriksaan');
    $routes->post('store-pemeriksaan', 'PendaftaranController::storePemeriksaan');
    $routes->get('pendaftar', 'PendaftaranController::indexPendaftar');
    $routes->get('pendaftar-list', 'PendaftaranController::pemeriksaanList');
    $routes->get('pendaftar/show/(:any)', 'PendaftaranController::showPemeriksaan/$1');
});

$routes->group('sampling', static function ($routes) {
    $routes->get('/', 'Home::sampling');
    $routes->get('laboratorium', 'LaboratoriumController::index');
    $routes->get('petugas-list', 'LaboratoriumController::petugasList');
    $routes->post('petugas-delete', 'LaboratoriumController::petugasDelete');
    $routes->get('laboratorium/add', 'LaboratoriumController::formPetugasAdd');
    $routes->post('petugas-add', 'LaboratoriumController::petugasAdd');
    $routes->get('laboratorium/edit', 'LaboratoriumController::formPetugasEdit');
    $routes->post('petugas-edit', 'LaboratoriumController::petugasEdit');
    $routes->get('pendaftar', 'LaboratoriumController::indexPendaftar');
    $routes->get('pendaftar-list', 'LaboratoriumController::pemeriksaanList');
    $routes->get('pendaftar/show/(:any)/(:any)', 'LaboratoriumController::showPemeriksaan/$1/$2');
    $routes->get('pendaftar/pengambilan-sample/(:any)/(:any)/(:any)', 'LaboratoriumController::showPengambilanSample/$1/$2/$3');
    $routes->post('pendaftar/add-pengambilan-sample/(:any)', 'LaboratoriumController::addPengambilanSample/$1');
});

$routes->group('pemeriksaan', static function ($routes) {
    $routes->get('/', 'Home::pemeriksaan');

    $routes->get('data-pemeriksaan', 'PemeriksaanController::index');
    $routes->get('data-pemeriksaan-list', 'PemeriksaanController::dataPemeriksaanList');
    $routes->get('data-pemeriksaan/show/(:any)/(:any)', 'PemeriksaanController::showPemeriksaan/$1/$2');

    $routes->get('hasil-pemeriksaan', 'PemeriksaanController::indexHasilPemeriksaan');
    $routes->get('hasil-pemeriksaan-list', 'PemeriksaanController::hasilPemeriksaanList');
    $routes->get('hasil-pemeriksaan/hasil/(:any)/(:any)', 'PemeriksaanController::showHasilPemeriksaan/$1/$2');

    $routes->get('laboratorium', 'PemeriksaanController::indexPetugas');
    $routes->get('petugas-list', 'PemeriksaanController::petugasList');
    $routes->post('petugas-delete', 'PemeriksaanController::petugasDelete');
    $routes->get('laboratorium/add', 'PemeriksaanController::formPetugasAdd');
    $routes->post('petugas-add', 'PemeriksaanController::petugasAdd');
    $routes->get('laboratorium/edit', 'PemeriksaanController::formPetugasEdit');
    $routes->post('petugas-edit', 'PemeriksaanController::petugasEdit');
});

$routes->group('validasi', static function ($routes) {
    $routes->get('/', 'Home::validasi');

    $routes->get('hasil-pemeriksaan', 'ValidasiController::indexHasilPemeriksaan');
    $routes->get('hasil-pemeriksaan-list', 'ValidasiController::hasilPemeriksaanList');
    $routes->get('hasil-pemeriksaan/show/(:any)/(:any)', 'ValidasiController::showPemeriksaan/$1/$2');
    $routes->get('hasil-pemeriksaan/process-validation/(:any)/(:any)', 'ValidasiController::validasiPemeriksaan/$1/$2');
});
