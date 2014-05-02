<?php

require APPPATH .'vendor/autoload.php';
require APPPATH .'packages/autoloader.php';
require APPPATH .'constants.php';

define('DS', DIRECTORY_SEPARATOR);

ORM::configure('mysql:host=localhost;dbname=schedulab;');
if (PHP_OS === 'Darwin') {
   ORM::configure('mysql:host=localhost;dbname=schedulab;unix_socket=/tmp/mysql.sock;');
}
ORM::configure('username', 'schedulab');
ORM::configure('password', 'schedulab');

Autoloader::register();

Session::start();
