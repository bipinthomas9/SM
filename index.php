<?php 

	error_reporting( E_ALL );
	ini_set( 'display_errors', 1 );

	$GLOBALS[ 'config' ] = array(
		'appName'	=> 'phpSteroid',
		'version'	=> '0.0.1',
		'domain'	=> 'phpSteroid.com',
		'path'		=> array(
			'app'	=> 'app/',
			'core'	=> 'core/',
			'index'	=> 'index.php',
		),
		'defaults'	=> array(
			'controller'	=> 'CMainController',
			'method'		=> 'index',
		),
		'routes'	=> array(),
		'database'	=> array(
			'host'		=> 'localhost',
			'username'	=> 'root',
			'password'	=> '',
			'name'		=> 'socman',
		)
	);
	$GLOBALS[ 'instances' ]	= array();
	require_once $GLOBALS[ 'config' ][ 'path' ][ 'core' ] . 'autoload.php';
	new CRouter();
