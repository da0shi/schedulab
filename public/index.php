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
	$request = $app->request();
	$name = $request->post('name');
	$email = $request->post('email');
	$password = $request->post('password');
	$result = User::create($name, $email, $password);
	if (is_array($result) && $result['hasError']) {
		if (isset($result['empty-value'])) {
			$app->flashNow('emptyval', $result['empty-value']);
		}
		if (isset($result['duplicate-email'])) {
			$app->flashNow('duplicate', $result['duplicate-email']);
		}
		if (isset($result['short-password'])) {
			$app->flashNow('shortpass', $result['short-password']);
		}
		return $app->render('signup.php');
	} else if ($result === false) {
		$app->flashNow('failed', 'データベースへの登録に失敗しました．');
		return $app->render('signup.php');
	}
	$user = Model::factory('User')->where_equal('id', $result)->find_one();
	Session::write('auth.user', $user);
	Session::write('auth.login', true);
});

$app->get('/signin', function () use ($app) {
	$app->render('signin.php');
});

$app->post('/signin', function () use ($app) {
});

$app->get('/schedule/create', function() use($app) {
	$app->render('schedule/create.php');
});

$app->post('/schedule/create', function() use($app) {
	$args = array();
	$args['title'] = Input::post('title');
	$args['startDate'] = Input::post('start-date');
	$args['startTime'] = Input::post('start-time');
	$args['endDate'] = Input::post('end-date');
	$args['endTime'] = Input::post('end-time');
	$args['detail'] = Input::post('detail');
	$args['allday'] = Input::post('allday');
	$result = Schedule::create($args);
	if (is_array($result) && $result['hasError']) {
		if (isset($result['empty-title'])) {
			$app->flashNow('emptytitle', $result['empty-title']);
		}
		if (isset($result['empty-date'])) {
			$app->flashNow('emptydate', $result['empty-date']);
		}
		if (isset($result['invalid-date'])) {
			$app->flashNow('invalid', $result['invalid-date']);
		}
		return $app->render('schedule/create.php');
	}
	var_dump(Model::factory('Schedule')->where_equal('title', $args['title'])->find_one());
});

$app->get('/hello/:name', function ($name) {
	echo "Hello, $name";
});

$app->run();
