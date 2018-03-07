<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['login'] = 'login/index';
$route['home'] = 'home/index';
$route['inventory'] = 'inventory/index';
$route['admin'] = 'admin/index';
$route['about'] = 'about/index';
$route['register'] = 'register/index';
$route['default_controller'] = 'login/index';
$route['(:any)']='pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;