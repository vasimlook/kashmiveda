<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index',['as' => 'home']);
$routes->post('contact-save', 'Home::contactSave',['as' => 'contact_save']);

$routes->group('admin', function ($routes) {
    $routes->get('login', 'Admin\Auth::login', ['as' => 'admin_login']);
    $routes->post('loginProcess', 'Admin\Auth::loginProcess', ['as' => 'admin_login_process']);
    $routes->get('logout', 'Admin\Auth::logout', ['as' => 'admin_logout']);
});

$routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index', ['as' => 'admin_dashboard']);

    $routes->get('change-password', 'Admin\Auth::changePassword',['as' => 'admin_change_password']);
    $routes->post('update-password', 'Admin\Auth::updatePassword',['as' => 'admin_update_password']);

    $routes->get('user-list', 'Admin\User::index', ['as' => 'admin_user_list']);
    $routes->post('user-update-status', 'Admin\User::updateStatus', ['as' => 'admin_user_update_status']);
    $routes->get('user-team/(:any)', 'Admin\User::teamList/$1', ['as' => 'admin_user_team']);
    $routes->post('user-team-level-wise', 'Admin\User::teamListLevelWise', ['as' => 'admin_user_team_level_wise']);
    
    $routes->get('contact-inquiry', 'Admin\Dashboard::contactInquiryList', ['as' => 'admin_contact_inquiry_list']);

    $routes->get('withdrawal-request', 'Admin\Withdrawal::index', ['as' => 'admin_withdrawal_request']);
    $routes->get('accept-reject-withdrawal-request/(:num)/(:num)', 'Admin\Withdrawal::acceptRejectWithdrawal/$1/$2', ['as' => 'admin_accept_reject_withdrawal_request']);
});


$routes->group('user', function ($routes) {
    $routes->get('register/(:any)', 'User\Auth::register/$1', ['as' => 'user_register_ref']);
    $routes->get('register', 'User\Auth::register', ['as' => 'user_register']);
    $routes->post('registerProcess', 'User\Auth::registerProcess', ['as' => 'user_register_process']);
    $routes->match(['get', 'post'], 'verify-otp/(:any)', 'User\Auth::verifyOtp/$1', ['as' => 'user_verify_otp']);

    $routes->get('login', 'User\Auth::login', ['as' => 'user_login']);
    $routes->post('loginProcess', 'User\Auth::loginProcess', ['as' => 'user_login_process']);

    $routes->match(['get', 'post'], 'forgot-password', 'User\Auth::forgotPassword', ['as' => 'user_forgot_password']);
    $routes->match(['get', 'post'], 'new-password/(:any)', 'User\Auth::newPassword/$1', ['as' => 'user_new_password']);
});

$routes->group('user', ['filter' => 'userAuth'], function ($routes) {
    $routes->get('dashboard', 'User\Dashboard::index', ['as' => 'user_dashboard']);
    $routes->get('logout', 'User\Auth::logout', ['as' => 'user_logout']);

    $routes->get('change-password', 'User\Auth::changePassword',['as' => 'user_change_password']);
    $routes->post('update-password', 'User\Auth::updatePassword',['as' => 'user_update_password']);
    
    $routes->get('my-team', 'User\MyTeam::index',['as' => 'user_my_team']);
    $routes->match(['get', 'post'], 'bank-detail', 'User\Dashboard::bankDetail', ['as' => 'user_bank_detail']);

    $routes->match(['get', 'post'], 'withdrawal', 'User\Withdrawal::index', ['as' => 'user_withdrawal']);
    $routes->get('withdrawal-history', 'User\Withdrawal::withdrawalHistoryList',['as' => 'user_withdrawal_history_list']);
});

