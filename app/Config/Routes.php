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
    $routes->get('viewemployeespersonals', 'Admin::viewEmployeesPersonals');
    $routes->get('editemployeepersonals/(:any)', 'Admin::editEmployeePersonals/$1');
    $routes->post('processeditemployeepersonals', 'Admin::processEditEmployeePersonals');
    $routes->get('confirmdeleteemployee/(:any)', 'Admin::confirmDeleteEmployee/$1');
    $routes->get('deleteemployee/(:any)', 'Admin::deleteEmployee/$1');
    $routes->get('viewemployeesfinancials', 'EmployeeFinancials::viewEmployeesFinancials');
    $routes->get('assignmentsmenu/(:any)', 'EmployeeFinancials::loadAssignmentsMenu/$1');
    $routes->get('assignbenefit/(:any)', 'EmployeeFinancials::assignBenefit/$1');
    $routes->post('processassignbenefit/(:any)', 'EmployeeFinancials::processAssignBenefit/$1');
    $routes->get('assignallowance/(:any)', 'EmployeeFinancials::assignAllowance/$1');
    $routes->post('processassignallowance/(:any)', 'EmployeeFinancials::processAssignAllowance/$1');
    $routes->get('assigndeduction/(:any)', 'EmployeeFinancials::assignDeduction/$1');
    $routes->post('processassigndeduction/(:any)', 'EmployeeFinancials::processAssignDeduction/$1');
    $routes->get('editsmenu/(:any)', 'EmployeeFinancials::loadEditsMenu/$1');
    $routes->get('viewassignedbenefits/(:any)', 'EmployeeFinancials::viewAssignedBenefits/$1');
    $routes->get('editassignedbenefit/(:any)', 'EmployeeFinancials::editAssignedBenefit/$1');
    $routes->post('processeditassignedbenefit/(:any)', 'EmployeeFinancials::processEditAssignedBenefit/$1');
    $routes->get('confirmdeleteassignedbenefit/(:any)', 'EmployeeFinancials::confirmDeleteAssignedBenefit/$1');
    $routes->get('deleteassignedbenefit/(:any)', 'EmployeeFinancials::deleteAssignedBenefit/$1');
    $routes->get('viewassignedallowances/(:any)', 'EmployeeFinancials::viewAssignedAllowances/$1');
    $routes->get('editassignedallowance/(:any)', 'EmployeeFinancials::editAssignedAllowance/$1');
    $routes->post('processeditassignedallowance/(:any)', 'EmployeeFinancials::processEditAssignedAllowance/$1');
    $routes->get('confirmdeleteassignedallowance/(:any)', 'EmployeeFinancials::confirmDeleteAssignedAllowance/$1');
    $routes->get('deleteassignedallowance/(:any)', 'EmployeeFinancials::deleteAssignedAllowance/$1');
    $routes->get('viewassigneddeductions/(:any)', 'EmployeeFinancials::viewAssignedDeductions/$1');
    $routes->get('editassigneddeduction/(:any)', 'EmployeeFinancials::editAssignedDeduction/$1');
    $routes->post('processeditassigneddeduction/(:any)', 'EmployeeFinancials::processEditAssignedDeduction/$1');
    $routes->get('confirmdeleteassigneddeduction/(:any)', 'EmployeeFinancials::confirmDeleteAssignedDeduction/$1');
    $routes->get('deleteassigneddeduction/(:any)', 'EmployeeFinancials::deleteAssignedDeduction/$1');
  });
  $routes->group('financials', function ($routes) {
    $routes->get('/', 'Admin::loadFinancialsMenu');
    $routes->get('viewtaxbrackets', 'SystemFinancials::viewTaxBrackets');
    $routes->get('nhif', 'SystemFinancials::nhifPage');
    $routes->get('nssf', 'SystemFinancials::nssfPage');
    $routes->group('benefits', function ($routes) {
      $routes->get('/', 'Admin::loadBenefitsMenu');
      $routes->get('addbenefit', 'SystemFinancials::addBenefit');
      $routes->post('processaddbenefit', 'SystemFinancials::processAddBenefit');
      $routes->get('viewbenefits', 'SystemFinancials::viewBenefits');
      $routes->get('editbenefit/(:any)', 'SystemFinancials::editBenefit/$1');
      $routes->post('processeditbenefit', 'SystemFinancials::processEditBenefit');
      $routes->get('confirmdeletebenefit/(:any)', 'SystemFinancials::confirmDeleteBenefit/$1');
      $routes->get('deletebenefit/(:any)', 'SystemFinancials::deleteBenefit/$1');
    });
    $routes->group('allowances', function ($routes) {
      $routes->get('/', 'Admin::loadAllowancesMenu');
      $routes->get('addallowance', 'SystemFinancials::addAllowance');
      $routes->post('processaddallowance', 'SystemFinancials::processAddAllowance');
      $routes->get('viewallowances', 'SystemFinancials::viewAllowances');
      $routes->get('editallowance/(:any)', 'SystemFinancials::editAllowance/$1');
      $routes->post('processeditallowance', 'SystemFinancials::processEditAllowance');
      $routes->get('confirmdeleteallowance/(:any)', 'SystemFinancials::confirmDeleteAllowance/$1');
      $routes->get('deleteallowance/(:any)', 'SystemFinancials::deleteAllowance/$1');
    });
    $routes->group('deductions', function ($routes) {
      $routes->get('/', 'Admin::loadDeductionsMenu');
      $routes->get('adddeduction', 'SystemFinancials::addDeduction');
      $routes->post('processadddeduction', 'SystemFinancials::processAddDeduction');
      $routes->get('viewdeductions', 'SystemFinancials::viewDeductions');
      $routes->get('editdeduction/(:any)', 'SystemFinancials::editDeduction/$1');
      $routes->post('processeditdeduction', 'SystemFinancials::processEditDeduction');
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
