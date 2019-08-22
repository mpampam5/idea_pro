<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'backend/login/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Page login Admin
$route['adm-panel']        = 'adm-backend/login';
$route['adm-panel/action'] = 'adm-backend/login/action';
$route['adm-panel/logout'] = 'adm-backend/login/logout';

//Page login Member
$route['member-panel'] = 'backend/login/login';
$route['member-panel/action'] = 'backend/login/login/action';
$route['backend/logout'] = 'backend/login/login/logout';

$route['member-register'] = 'backend/register/register';
$route['referral/(:any)'] = 'backend/register/register/referral/$1';
$route['member-register/action'] = 'backend/register/register/action';

$route['member-register/jsonkabupaten'] = 'backend/register/register/kabupaten';
$route['member-register/jsonkecamatan'] = 'backend/register/register/kecamatan';
$route['member-register/jsonkelurahan'] = 'backend/register/register/kelurahan';
