<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Alternatif::index');

$routes->get('alternatif', 'Alternatif::index');
$routes->post('alternatif/tambah', 'Alternatif::tambah');
$routes->post('alternatif/ubah/(:num)', 'Alternatif::ubah/$1');
$routes->post('alternatif/hapus/(:num)', 'Alternatif::hapus/$1');

$routes->get('hasil', 'Hasil::index');
$routes->post('hasil/tambah', 'Hasil::tambah');
$routes->post('hasil/ubah/(:num)', 'Hasil::ubah/$1');
$routes->delete('hasil/hapus/(:num)', 'Hasil::hapus/$1');

$routes->get('kriteria', 'Kriteria::index');
$routes->post('kriteria/tambah', 'Kriteria::tambah');
$routes->post('kriteria/ubah/(:num)', 'Kriteria::ubah/$1');
$routes->post('kriteria/hapus/(:num)', 'Kriteria::hapus/$1');

$routes->get('nilaialter', 'NilaiAlter::index');
$routes->post('nilaialter/ubah/(:num)', 'NilaiAlter::ubah/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
