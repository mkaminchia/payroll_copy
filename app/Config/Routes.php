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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->group('login', function ($routes) {
    $routes->post('processlogin', 'Login::processlogin');
    $routes->get('logout', 'Login::logout');
  });

$routes->group('employee', function ($routes) {
    $routes->get('/', 'Employee::index');
    $routes->get('profile', 'Employee::profile');
    $routes->get('payslip', 'Employee::payslip');
    //$routes->get('categorycatalogue/(:any)', 'Catalogue::categorycatalogue/$1');
  });

$routes->group('admin', function ($routes) {
  $routes->get('/', 'Admin::index');
  $routes->group('profile', function ($routes) {
    $routes->get('/', 'Admin::loadProfileMenu');
    $routes->get('viewprofile', 'Admin::viewProfile');
    $routes->get('editprofile', 'Admin::editProfile');
    $routes->get('deleteprofile', 'Admin::deleteProfile');
    $routes->post('processeditprofile', 'Admin::processEditProfile');
  });
  $routes->group('employees', function ($routes) {
    $routes->get('/', 'Admin::loadEmployeesMenu');
    $routes->get('addemployee', 'Admin::addEmployee');
    $routes->post('processaddemployee', 'Admin::processAddEmployee');
  });
  $routes->group('financials', function ($routes) {
    $routes->get('/', 'Admin::loadFinancialsMenu');
    $routes->group('benefits', function ($routes) {
      $routes->get('/', 'Admin::loadBenefitsMenu');
      $routes->get('addbenefit', 'SystemFinancials::addBenefit');
      $routes->post('processaddbenefit', 'SystemFinancials::processAddBenefit');
    });
    $routes->group('allowances', function ($routes) {
      $routes->get('/', 'Admin::loadAllowancesMenu');
      $routes->get('addallowance', 'SystemFinancials::addAllowance');
      $routes->post('processaddallowance', 'SystemFinancials::processAddAllowance');
      $routes->get('viewallowances', 'SystemFinancials::viewAllowances');
      $routes->get('confirmdeleteallowance/(:any)', 'SystemFinancials::confirmDeleteAllowance/$1');
      $routes->get('deleteallowance/(:any)', 'SystemFinancials::deleteAllowance/$1');
    });
    $routes->group('deductions', function ($routes) {
      $routes->get('/', 'Admin::loadDeductionsMenu');
      $routes->get('adddeduction', 'SystemFinancials::addDeduction');
      $routes->post('processadddeduction', 'SystemFinancials::processAddDeduction');
      $routes->get('viewdeductions', 'SystemFinancials::viewDeductions');
      $routes->get('confirmdeletededuction/(:any)', 'SystemFinancials::confirmDeleteDeduction/$1');
      $routes->get('deletededuction/(:any)', 'SystemFinancials::deleteDeduction/$1');
    });
  });
});

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
