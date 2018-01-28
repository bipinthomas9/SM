<?php

class CRouter {

	private $m_arrRoute;

	function __construct() {
//		$this->m_arrRoute	= $GLOBALS[ 'config' ][ 'routes' ];
		$this->m_arrRoute	= CRouteDefinitions::getAllRoutes();
		$strRoute			= $this->testGetRoute();
		if( class_exists( $strRoute[ 'controller' ] ) ) {
			$objController		= new $strRoute[ 'controller' ]();
			$strFunctionName	= $strRoute[ 'method' ];
			if( method_exists( $objController, $strRoute[ 'method' ] ) ) {
				$objController->$strFunctionName();
			}else {
				CErrorHandler::showError(404);
			}
		}else {
			CErrorHandler::showError(404);
		}
	}

	private function testGetRoute() {
		$arrUrlParts = explode( '/', $_SERVER[ 'REQUEST_URI' ] );
		$intCounter = 1;
		$strMethodName = $GLOBALS[ 'config' ][ 'defaults' ][ 'method' ];
		$strControllerUrl = 'index';
		$strControllerName = $GLOBALS[ 'config' ][ 'defaults' ][ 'controller' ];
		foreach ( $arrUrlParts as $key => $value ) {
			if( NULL != $value || '' != $value ) {
				if( array_key_exists( $value, $this->m_arrRoute[ 'routes' ] ) && $intCounter == 1 ) {
					$strControllerName	= $this->m_arrRoute[ 'routes' ][ $value ][ 'controller' ];
					$strControllerUrl	= $value;
				}else if( 1 < $intCounter && array_key_exists( $value, $this->m_arrRoute[ 'routes' ][ $strControllerUrl ][ 'subActions' ] ) ) {
					$strMethodName = $this->m_arrRoute[ 'routes' ][ $strControllerUrl ][ 'subActions' ][ $value ];
				}else if( 1 < $intCounter ) {
					$strControllerName	= $value;
				}else {
					$strMethodName		= $value;
				}
				$intCounter++;
			}
		}
		return  [
			'controller'	=> $strControllerName,
			'method'		=> $strMethodName
		];
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

	static function getUri( $intUrlPart ) {
		$arrUrlParts = explode( '/', $_SERVER[ 'REQUEST_URI' ] );

		if( $arrUrlParts[ 1 ] == $GLOBALS[ 'config' ][ 'path' ][ 'index' ] ) {
			$intUrlPart++;
		}
		return ( isset( $arrUrlParts[ $intUrlPart ] ) ) ? $arrUrlParts[ $intUrlPart ] : '';
	}
}