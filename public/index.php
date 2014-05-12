<?php
error_reporting(-1);
ini_set('display_errors', 1);

define('DOCROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('APPPATH', realpath(__DIR__ .'/../app') . DIRECTORY_SEPARATOR);

require APPPATH .'bootstrap.php';

use \Slim as Slib;
use \Slim\Slim as Slim;

$config = array(
	'debug' => true,
	'log.level' => Slib\Log::DEBUG,
	'templates.path' => APPPATH .'views',
	'cookies.lifetime' => '60 minutes',
);

$app = new Slim($config);
$app->setName('schedulab');

$app->view->setData('title', $app->getName());

$app->get('/', function () use ($app) {
	$app->render('index.php');
});

$app->get('/signup', function () use ($app) {
	$app->render('signup.php');
});

$app->post('/signup', function () use ($app) {
	$name = Input::post('name');
	$email = Input::post('email');
	$password = Input::post('password');
	$result = User::create($name, $email, $password);
	if ($result === false) {
		$app->view->set('duplicate', Session::flash('duplicate-email'));
		$app->view->set('shortpass', Session::flash('short-password'));
		return $app->render('signup.php');
	}
	var_dump(Model::factory('User')->where_equal('email', $email)->find_one());
});

$app->get('/schedule/create', function() use($app) {
	$app->render('schedule/create.php');
});

$app->post('/schedule/create', function() use($app) {
	$title = Input::post('title');
	$startDate = Input::post('start-date');
	$startTime = Input::post('start-time');
	$endDate = Input::post('end-date');
	$endTime = Input::post('end-time');
	$detail = Input::post('detail');
	$allday = Input::post('allday');
	print_r($_POST);
});

$app->get('/hello/:name', function ($name) {
	echo "Hello, $name";
});

$app->run();
