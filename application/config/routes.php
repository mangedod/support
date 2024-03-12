<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'id';
$route['404_override'] = '';
$route['dashboard'] = 'is';
$route['profile'] = 'is/editprofil';
$route['settings'] = 'is/settings';
$route['jobdesk'] = 'is/jobdesk';
$route['menu'] = 'is/menus';
$route['akses'] = 'is/role';
$route['akses/(:any)'] = 'is/akses/$1';
$route['translate_uri_dashes'] = false;
