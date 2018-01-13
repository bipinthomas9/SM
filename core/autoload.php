<?php
	 spl_autoload_register( function( $class ) {
	 	//var_dump( $class );echo '<br>';
		$strCoreDirPath	= $GLOBALS[ 'config' ][ 'path' ][ 'core' ];
		$strAppDirPath	= $GLOBALS[ 'config' ][ 'path' ][ 'app' ];

		if( file_exists( $strCoreDirPath . 'abstracts/' . $class . '.php' ) ) {
			require_once $strCoreDirPath . 'abstracts/' . $class . '.php';
		} else if( file_exists( $strCoreDirPath . 'classes/' . $class . '.class.php' ) ) {
			require_once $strCoreDirPath . 'classes/' . $class . '.class.php';
		} else if( file_exists( $strCoreDirPath . 'interfaces/' . $class . '.php' ) ) {
			require_once $strCoreDirPath . 'interfaces/' . $class . '.php';
		} else if( file_exists( $strAppDirPath . 'controllers/' . $class . '.class.php' ) ) {
			require_once $strAppDirPath . 'controllers/' . $class . '.class.php';
		} else if( file_exists( $strAppDirPath . 'libs/' . $class . '.class.php' ) ) {
			require_once $strAppDirPath . 'libs/' . $class . '.class.php';
		} else if( file_exists( $strAppDirPath . 'models/' . $class . '.class.php' ) ) {
			require_once $strAppDirPath . 'models/' . $class . '.class.php';
		} else if( file_exists( $strAppDirPath . 'interfaces/' . $class . '.class.php' ) ) {
			require_once $strAppDirPath . 'interfaces/' . $class . '.class.php';
		} else if( file_exists( $strAppDirPath . 'abstracts/' . $class . '.class.php' ) ) {
			require_once $strAppDirPath . 'abstracts/' . $class . '.class.php';
		}
	 } );