<?php

require APPPATH .'vendor/autoload.php';

require_once 'idiorm.php';
require_once 'paris.php';


ORM::configure('mysql:host=localhost;dbname=schedulab');
ORM::configure('username', 'schedulab');
ORM::configure('password', 'schedulab');
