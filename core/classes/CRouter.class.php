<?php

class CRouter {

	private $m_arrRoute;

	function __construct() {
		$this->m_arrRoute	= $GLOBALS[ 'config' ][ 'routes' ];
		$strRoute			= $this->getRoute();
		if( class_exists( $strRoute[ 'controller' ] ) ) {
			$objController	= new $strRoute[ 'controller' ]();
			if( method_exists( $objController, $strRoute[ 'method' ] ) ) {
				$objController->$strRoute[ 'method' ]();
			}else {
				CErrorHandler::showError(404);
			}
		}else {
			CErrorHandler::showError(404);
		}
	}

	private function getRoute() {
		foreach ( $this->m_arrRoute as $strRoute) {
			$strParts = $this->getRoutePart( $strRoute );
			$boolAllMatch	= true;
			foreach ( $strParts as $key => $value ) {
				if( $value != '*' ) {
					if( CRouter::getUri( $key ) != $value ) {
						$boolAllMatch = false;
					}
				}
			}
			if( $boolAllMatch ) {
				return $strRoute;
			}
		}
		$strUriOne	= CRouter::getUri( 1 );
		$strUriTwo	= CRouter::getUri( 2 );
		if( $strUriOne == '' ) {
			$strUriOne	= $GLOBALS[ 'config' ][ 'defaults' ][ 'controller' ];
		}
		if( $strUriTwo == '' ) {
			$strUriTwo	= $GLOBALS[ 'config' ][ 'defaults' ][ 'method' ];
		}

		return [
			'controller'	=> $strUriOne,
			'method'		=> $strUriTwo
		];
	}

	private function getRoutePart( $arrRoute ) {
		if( is_array( $arrRoute ) ) {
			$arrRoute =  $arrRoute[ 'url' ];
		}
		return explode( '/', $arrRoute );
	}

	static function getUri( $strPart ) {
		$strParts = explode( '/', $_SERVER[ 'REQUEST_URI' ] );
		if( $strParts[ 1 ] == $GLOBALS[ 'config' ][ 'path' ][ 'index' ] ) {
			$strPart++;
		}
		return ( isset( $strParts[ $strPart ] ) ) ? $strParts[ $strPart ] : '';
	}
}