<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



/*
| -------------------------------------------------------------------------
| URI ROUTING for LLM Proxy
| -------------------------------------------------------------------------
|
| Añade estas rutas a tu archivo application/config/routes.php
| para configurar los endpoints del proxy LLM
|
*/

// Endpoint principal para peticiones al proxy
$route['api/llm-proxy']['post'] = 'llmproxy/index';
// $route['api/llm-proxy']['options'] = 'llmproxy/index';

// Endpoint para verificar cuota
$route['api/quota']['get'] = 'llmproxy/quota';
$route['api/quota']['options'] = 'llmproxy/quota';

// Endpoint de instalación (protegido, solo para administradores)
$route['api/llm-proxy/install']['get'] = 'llmproxy/install';

// Endpoint de estado del proxy
$route['api/llm-proxy/status']['get'] = 'llmproxy/status';

$route['api/llm-proxy']['options'] = 'llmproxy/options';
$route['api/llm-proxy/test-connection']['get'] = 'llmproxy/test_connection';


$route['test/cors']['get'] = 'cors_test/index';
$route['test/cors']['options'] = 'cors_test/options';

$route['usage']['get'] = 'usage/index';
$route['usage']['get'] = 'usage/logs';
$route['usage']['get'] = 'usage/quotas';
$route['usage']['get'] = 'usage/providers';


// Rutas de gestión de tenants
$route['tenants']['get'] = 'tenants/index';
$route['tenants/create']['get'] = 'tenants/create';
$route['tenants/create']['post'] = 'tenants/create';
$route['tenants/view/(:any)']['get'] = 'tenants/view/$1';
$route['tenants/delete/(:any)']['get'] = 'tenants/delete/$1';
$route['tenants/delete/(:any)']['post'] = 'tenants/delete/$1';
$route['tenants/usage/(:any)']['get'] = 'tenants/usage/$1';

// Rutas para gestión de usuarios dentro de tenants
$route['tenants/add_user/(:any)']['get'] = 'tenants/add_user/$1';
$route['tenants/add_user/(:any)']['post'] = 'tenants/add_user/$1';
$route['tenants/edit_user/(:any)/(:any)']['get'] = 'tenants/edit_user/$1/$2';
$route['tenants/edit_user/(:any)/(:any)']['post'] = 'tenants/edit_user/$1/$2';
$route['tenants/delete_user/(:any)/(:any)']['get'] = 'tenants/delete_user/$1/$2';
$route['tenants/delete_user/(:any)/(:any)']['post'] = 'tenants/delete_user/$1/$2';
