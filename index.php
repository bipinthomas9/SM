<?php 

	error_reporting( E_ALL );
	ini_set( 'display_errors', 1 );

	$GLOBALS[ 'config' ] = array(
		'addName'	=> 'phpSteroid',
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
			'username'	=> '',
			'password'	=> '',
			'name'		=> '',
		)
	);
	$GLOBALS[ 'instances' ]	= array();
	require_once $GLOBALS[ 'config' ][ 'path' ][ 'core' ] . 'autoload.php';
	new CRouter();
