<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "welcome";

// Routes for the teachers
$route['teachers'] = "teachers";
$route['teachers/get_all_teachers'] = "teachers/get_all_teachers";  
$route['teachers/create'] = "teachers/create";
$route['teachers/update/(:num)'] = "teachers/update/$1";  
$route['teachers/delete'] = "teachers/delete"; 
  

$route['404_override'] = '';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
