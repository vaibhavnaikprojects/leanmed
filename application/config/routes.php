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
$route['api/users/(:any)']['get'] = 'user/detail/$1';
$route['api/users']['post'] = 'user/create';
$route['api/users/(:any)']['put'] = 'user/update/$1';
$route['api/users/(:any)']['delete'] = 'user/delete/$1';
$route['api/users/userstatus']['post'] = 'user/updateuserstatus';
$route['api/users/userstatus/(:num)']['get'] = 'user/userByStatus/$1';
$route['api/users/userstatus/name/(:any)']['get'] = 'user/userByStatusByName/$1';
$route['api/zones']['get'] = 'user/zones';
$route['api/zones/(:any)']['get'] = 'user/zoneDetail/$1';
$route['api/zones/countries']['get'] = 'user/zones';
$route['api/zones/countries/(:any)']['get'] = 'user/zoneByCountry/$1';
$route['api/inventory']['get'] = 'inventory/all';
$route['api/inventory/(:any)']['get'] = 'inventory/index/$1';
$route['api/getdoninventory/(:any)']['get'] = 'inventory/getdonIndex/$1';
$route['api/orders']["post"] = 'orders/placeOrder';
$route['api/box']['post'] = 'shipment/placeShipmentOrder';
$route['api/box/shipments']['post'] = "shipment/getZoneShipments";
$route['api/box/shipments/medicine']['post'] = "shipment/getBoxContent";
$route['api/getdoninventory']['post'] = 'getdonInventory/addNewItemToInventory';
$route['api/orders']['get'] = 'recdon/allPatients';
$route['api/orders/(:any)']['get'] = 'recdon/patientDetails/$1';
$route['api/requests/(:any)']['get'] = 'recdon/getRequestsfromZone/$1';



$route['default_controller'] = 'login/index';
$route['(:any)']='pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;