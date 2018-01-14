<?php
	 spl_autoload_register( function( $class ) {
		 var_dump( $class,$GLOBALS[ 'instances' ] );
		$strCoreDirPath	= $GLOBALS[ 'config' ][ 'path' ][ 'core' ];
		$strAppDirPath	= $GLOBALS[ 'config' ][ 'path' ][ 'app' ];

		if( file_exists( $strCoreDirPath . 'abstracts/' . $class . '.php' ) ) {
			$boolIsInstantiable = false;
			require_once $strCoreDirPath . 'abstracts/' . $class . '.php';
		} else if( file_exists( $strCoreDirPath . 'classes/' . $class . '.class.php' ) ) {
			$boolIsInstantiable = true;
			require_once $strCoreDirPath . 'classes/' . $class . '.class.php';
		} else if( file_exists( $strCoreDirPath . 'interfaces/' . $class . '.php' ) ) {
			$boolIsInstantiable = false;
			require_once $strCoreDirPath . 'interfaces/' . $class . '.php';
		} else if( file_exists( $strAppDirPath . 'controllers/' . $class . '.class.php' ) ) {
			$boolIsInstantiable = true;
			require_once $strAppDirPath . 'controllers/' . $class . '.class.php';
		} else if( file_exists( $strAppDirPath . 'libs/' . $class . '.class.php' ) ) {
			$boolIsInstantiable = true;
			require_once $strAppDirPath . 'libs/' . $class . '.class.php';
		} else if( file_exists( $strAppDirPath . 'models/' . $class . '.class.php' ) ) {
			$boolIsInstantiable = true;
			require_once $strAppDirPath . 'models/' . $class . '.class.php';
		} else if( file_exists( $strAppDirPath . 'interfaces/' . $class . '.class.php' ) ) {
			$boolIsInstantiable = false;
			require_once $strAppDirPath . 'interfaces/' . $class . '.class.php';
		} else if( file_exists( $strAppDirPath . 'abstracts/' . $class . '.class.php' ) ) {
			$boolIsInstantiable = false;
			require_once $strAppDirPath . 'abstracts/' . $class . '.class.php';
		}

		if( $boolIsInstantiable ) {
			foreach( $GLOBALS[ 'instances' ] as $instance ) {
				$instance->$class	= new $class();
			}
		}

	 } );