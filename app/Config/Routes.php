<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/nif', 'NifController::index');

// route des utilisateurs
$routes->post('/signup', 'UserController::signup');
$routes->post('/signin', 'UserController::signin');


// route de l'impot
$routes->get('/afficherImpot', 'ImpotController::index');
$routes->get('/afficherUnImpot/(:num)', 'ImpotController::afficherUnImpot/$1');
$routes->post('/creerImpot', 'ImpotController::creerImpot');

// route de NIF
$routes->post('/ajouterNif', 'NifController::ajouterNif');
$routes->get('/afficherNif', 'NifController::index');
$routes->get('/afficherNif/(:num)', 'NifController::afficher_simple_nif/$1');
$routes->delete('/supprimerNif/(:num)', 'NifController::supprimerNif/$1');
$routes->put('/modifierNif/(:num)', 'NifController::modifierNif/$1');

// route de saisie
$routes->post('/faireSaisie', 'SaisieController::faireSaisie');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
