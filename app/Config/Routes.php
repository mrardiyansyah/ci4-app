<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/public/', 'Auth::index');

// Login and Register
$routes->match(['get', 'post'], '/login', 'Auth::index');
$routes->addRedirect('/login/(:any)', 'login');
$routes->match(['get', 'post'], '/signup', 'Auth::registration');
$routes->addRedirect('/signup/(:any)', 'signup');
$routes->get('logout', 'Auth::logout');

// Blocked Page
$routes->get('blocked', 'Auth::blocked');

// Profile
$routes->get('/profile', 'Users\profile::index');
$routes->match(['get', 'post'], '/edit-profile', 'Users\profile::editProfile');

// Users
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Users\profile::index');
});

// Menu Manajemen
$routes->group('menu', ['filter' => 'auth'], function ($routes) {
	$routes->match(['get', 'post'], '/', 'Admin\Menu::index');
	$routes->post('add-menu', 'Admin\Menu::add');
	$routes->post('edit-menu', 'Admin\Menu::edit');
	$routes->get('delete-menu/(:any)', 'Admin\Menu::delete/$1');
	$routes->addRedirect('delete-menu', '/');
});

// Sub Menu Manajemen
$routes->group('submenu', ['filter' => 'auth'], function ($routes) {
	$routes->match(['get', 'post'], '/', 'Admin\SubMenu::index');
	$routes->post('add-submenu', 'Admin\SubMenu::add');
	$routes->add('editSubMenu', 'Admin\SubMenu::editSubMenuModal');
	$routes->post('edit-submenu', 'Admin\SubMenu::edit');
	$routes->get('delete-submenu/(:any)', 'Admin\SubMenu::delete/$1');
	$routes->addRedirect('delete-menu', '/');
});
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
