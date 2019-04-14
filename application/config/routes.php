<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['login'] = 'login/index';
$route['home'] = 'home/index';
$route['inventory'] = 'inventory/index';
$route['admin'] = 'admin/index';
$route['activity'] = 'activity/index';
$route['about'] = 'about/index';
$route['register'] = 'register/index';
$route['forgot'] = 'forgot/index';
$route['users'] = 'users/index';


$route['api/login']['post'] = 'user/login';
$route['api/register']['post'] = 'user/register';


$route['api/users']['get'] = 'user';
$route['api/users/(:num)']['get'] = 'user/detail/$1';
$route['api/users']['post'] = 'user/create';
$route['api/users/(:num)']['put'] = 'user/update/$1';
$route['api/users/(:num)']['delete'] = 'user/delete/$1';
$route['api/zones']['get'] = 'user/zones';
$route['api/zones/(:num)']['get'] = 'user/zoneDetail/$1';
$route['api/zones/countries']['get'] = 'user/zones';
$route['api/zones/countries/(:num)']['get'] = 'user/zoneByCountry/$1';




$route['default_controller'] = 'login/index';
$route['(:any)']='pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;