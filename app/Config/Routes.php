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
$routes->match(['get', 'post'], 'forgot-password', 'Auth::forgotPassword');

// Activation Account with Email
$routes->get('verify-email', 'Auth::sendEmail');
$routes->get('verify-account', 'Auth::verify');

// Reset Password
$routes->get('reset-password', 'Auth::resetPassword');
$routes->put('reset-password', 'Auth::changePassword');

// Blocked Page
$routes->get('blocked', 'Auth::blocked');

// Profile
$routes->get('profile', 'Users\profile::index', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'edit-profile', 'Users\profile::editProfile', ['filter' => 'auth']);
$routes->get('change-password', 'Users\profile::changePassword', ['filter' => 'auth']);
$routes->PUT('change-password', 'Users\profile::changePassword', ['filter' => 'auth']);



// Administrator
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Users\profile::index');
	$routes->post('add-role', 'Admin\RoleManagement::add');
	$routes->get('role-management', 'Admin\RoleManagement::index');
	$routes->get('role-access/(:num)', 'Admin\RoleManagement::roleAccess/$1');
	$routes->post('change-access', 'Admin\RoleManagement::edit');
	$routes->delete('role-management/(:num)', 'Admin\RoleManagement::delete/$1');
	$routes->addRedirect('role-management/(:any)', 'admin/role-management');
	$routes->addRedirect('delete-role', '/');

	// User List
	$routes->get('user_list', 'Admin\UserAccounts::index');
	$routes->get('detail-user/(:num)', 'Admin\UserAccounts::detailUser/$1');
});

// Menu Manajemen
$routes->group('menu', ['filter' => 'auth'], function ($routes) {
	$routes->match(['get', 'post'], '/', 'Admin\Menu::index');
	$routes->post('add-menu', 'Admin\Menu::add');
	$routes->post('edit-menu', 'Admin\Menu::edit');
	$routes->get('delete-menu/(:any)', 'Admin\Menu::delete/$1');
	$routes->addRedirect('delete-menu', 'profile');
});

// Sub Menu Manajemen
$routes->group('submenu', ['filter' => 'auth'], function ($routes) {
	$routes->match(['get', 'post'], '/', 'Admin\SubMenu::index');
	$routes->post('add-submenu', 'Admin\SubMenu::add');
	$routes->add('editSubMenu', 'Admin\SubMenu::editSubMenuModal');
	$routes->post('edit-submenu', 'Admin\SubMenu::edit');
	$routes->delete('info/(:num)', 'Admin\Submenu::delete/$1');
	$routes->addRedirect('delete-submenu', '/');
});

// Account Executive
$routes->group('account-executive', ['filter' => 'auth'], function ($routes) {
	// Data Potential
	$routes->get('/', 'AccountExecutive\DataPotential::index');

	// Peremajaan Data Pelanggan
	$routes->get('rejuvenate/(:num)', 'AccountExecutive\RejuvenationData::index/$1');
	$routes->post('rejuvenate/(:num)', 'AccountExecutive\RejuvenationData::add/$1');

	// Probing (Kunjungan)
	$routes->get('probing/(:num)', 'AccountExecutive\Probing::index/$1');
	$routes->post('save-probing/(:num)', 'AccountExecutive\Probing::index/$1');

	// Cancellation Report
	$routes->get('cancellationReport/(:num)', 'AccountExecutive\Probing::confirmCancellation/$1');
	$routes->post('cancellationReport/(:num)', 'AccountExecutive\Probing::confirmCancellation/$1');

	// Confirm Closing (Upload Application Letter)
	$routes->get('closing/(:num)', 'AccountExecutive\Closing::index/$1');
	$routes->post('closing/(:num)', 'AccountExecutive\Closing::index/$1');

	// Upload File SPJBTL
	$routes->get('spjbtl/(:num)', 'AccountExecutive\Closing::addSPJBTL/$1');
	$routes->post('spjbtl/(:num)', 'AccountExecutive\Closing::addSPJBTL/$1');

	// Upload File Working Order
	$routes->get('working-order/(:num)', 'AccountExecutive\Closing::addWorkingOrder/$1');
	$routes->post('working-order/(:num)', 'AccountExecutive\Closing::addWorkingOrder/$1');
});

// Planning
$routes->group('planning', ['filter' => 'auth'], function ($routes) {
	// Master Data Pelanggan
	$routes->get('/', 'Planning\DataPotential::index');

	// Add Data Potential
	$routes->get('add-potential', 'Planning\AddPotential::index');
	$routes->put('add-potential', 'Planning\AddPotential::index');
	$routes->put('import-file', 'Planning\AddPotential::importFile');

	// Detail Customer
	$routes->get('detail-customer/(:num)', 'Planning\DataPotential::detailCustomer/$1');

	// Edit Detail Customer
	$routes->get('edit-customer/(:num)', 'Planning\DataPotential::editCustomer/$1');
	$routes->put('edit-customer/(:num)', 'Planning\DataPotential::editCustomer/$1');

	// Delete Customer
	$routes->delete('detail-customer/(:num)', 'Planning\DataPotential::delete/$1');

	// Incoming Request
	$routes->get('incoming-request', 'Planning\IncomingRequest::index');

	// Request Recommendation System
	$routes->get('request-potential', 'Planning\IncomingRequest::listRequestReksis');
	$routes->addRedirect('request-potential/(:any)', 'planning/request-potential');
	$routes->post('request-potential/(:num)', 'Planning\IncomingRequest::uploadReksis/$1');
	$routes->put('request-potential/(:num)', 'Planning\IncomingRequest::uploadReksis/$1');

	// Route for update information (Proses Reksis)
	$routes->post('process/(:num)', 'Planning\IncomingRequest::processReksis/$1');
});

// Construction (Pengawas)
$routes->group('construction', ['filter' => 'auth'], function ($routes) {
	// List Work Order
	$routes->get('/', 'Construction\WorkOrder::index');

	// Detail Customer
	$routes->add('detail/(:num)', 'Construction\WorkOrder::detailCustomer/$1');

	// Update Status to "On Construct"
	$routes->post('start/(:num)', 'Construction\WorkOrder::startConstruct/$1');

	// Construction Log Form
	$routes->add('log-form/(:num)', 'Construction\ReportLog::index/$1');

	// Edit Log Form
	$routes->add('edit-log-form/(:num)', 'Construction\ReportLog::editLog/$1');

	// Delete Log
	$routes->delete('delete-log/(:num)', 'Construction\ReportLog::deleteLog/$1');
});

// Managers
$routes->group('manager', ['filter' => 'auth'], function ($routes) {
	// Konstruksi
	$routes->group('konstruksi', ['filter' => 'auth'], function ($routes) {
		$routes->get('/', 'Managers\Konstruksi\WorkOrder::index');
		$routes->add('detail/(:num)', 'Managers\Konstruksi\WorkOrder::detail/$1');
		$routes->post('choose-pengawas/(:num)', 'Managers\Konstruksi\WorkOrder::pilihPengawas/$1');
	});
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
