<?php

class CUrl {

	static function partUrl( $intNumber ) {
		$arrstrUrl = explode( '?', $_SERVER[ 'REQUEST_URI' ] );
		$arrstrParts = explode(  '/', $arrstrUrl[ 0 ] );
		return ( isset( $arrstrParts[ $intNumber ] ) ? $arrstrParts[ $intNumber ] : false );
	}

	static function post( $key ) {
		return ( isset( $_POST[ $key ] ) ) ? $_POST[ $key ]: false;
	}

	static function get( $key ) {
		return ( isset( $_GET[ $key ] ) ) ? $_GET[ $key ] : false;
	}

	static function request( $key ) {
		if( CUrl::get( $key ) ) {
			return CUrl::get( $key );
		}elseif( CUrl::post( $key ) ) {
			return CUrl::post( $key );
		}else {
			return false;
		}
	}

	static function build( $url, $arrstrParams = array() ) {
		if( strpos( $url, '//' ) === false ) {
			$strPrefix = '//' . $GLOBALS[ 'config' ][ 'domain' ];
		}else {
			$strPrefix = '';
		}
		$strAppend = '';
		foreach ( $arrstrParams as $key => $value ) {
			$strAppend .= ( $strAppend == '' ) ? '?' : '&';
			$strAppend .= urlencode( $key ) . '=' . urlencode( $value );
		}
		return $strPrefix . $strAppend;
	}

	static function make( $url ) {
		if( strpos( $url, '//' ) === false ) {
			$strPrefix = '//' . $GLOBALS[ 'config' ][ 'domain' ];
		}else {
			$strPrefix = '';
		}
		return $strPrefix;
	}

	static function redirect( $strRedirectToUrl, $boolExit = true ) {
		if( headers_sent() ) {
			echo '<script>windows.location = ' .$strRedirectToUrl. '; </script>';
		}else {
			header( 'location:' . $strRedirectToUrl );
		}

		if ( $boolExit ) {
			die();
		}
	}

}