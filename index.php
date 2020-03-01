<?php 

	require_once('php-sdk/Meli/meli.php');
	require_once('php-sdk/configApp.php');

	session_start();
	
	$meli = new Meli(FileEnv::getEnv('App_ID'), FileEnv::getEnv('Secret_Key'));

	$url = $meli->getAuthUrl("http://localhost/test_meli", Meli::$AUTH_URL['MLB']);
	
	if (empty($_SESSION['header'])) {
		$_SESSION['header'] = 1;
		header("location: $url");
		exit;
	} else {
		echo "Já possuo o code <br>";

		$user = $meli->authorize($_GET['code'],'http://localhost/test_meli');
		
		print_r($meli->get('/users/me', array('access_token' => $user['body']->access_token)));
		

		
		session_unset();
		session_destroy();
	}

