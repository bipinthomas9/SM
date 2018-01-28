<?php 

	error_reporting( E_ALL );
	ini_set( 'display_errors', 1 );

	$GLOBALS[ 'config' ] = array(
		'appName'	=> 'socman',
		'version'	=> '0.0.1',
		'domain'	=> 'http://www.socman.com/',
		'logo'		=> 'assets/img/logo.png',
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
