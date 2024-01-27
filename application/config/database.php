<?php
defined('BASEPATH') or exit('No direct script access allowed');
$active_group = 'default';
$query_builder = true;

$db['default'] = array(
    'dsn' => '',
    'hostname' => 'localhost',
    'username' => 'kanz8438_support',
    'password' => 'Rimasantik4',
    'database' => 'kanz8438_support',
    // 'username' => 'root',
    // 'password' => '',
    // 'database' => 'support',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => false,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => false,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => false,
    'compress' => false,
    'stricton' => false,
    'failover' => array(),
    'save_queries' => true,
);
