<?php

class CSession {

	function __construct() {
		if( !isset( $_SESSION ) ) {
			session_start();
		}
		foreach ( $_COOKIE as $key => $value ) {
			if( !isset( $_SESSION[ $key ] ) ) {
				json_decode( $value );
				if( json_last_error() == JSON_ERROR_NONE ) {
					$_SESSION[ $key ] = json_decode( $value );
				}else {
					$_SESSION[ $key ] = $value;
				}
			}
		}
	}

	static function check( $arrKeys ) {
		if( is_array( $arrKeys ) ) {
			$boolSet = true;
			foreach ( $arrKeys as $key ) {
				if( !CSession::check( $key ) ) {
					$boolSet = false;
				}
			}
		}else {
			$key = CSession::generateSessionKey( $arrKeys );
			return isset( $_SESSION[ $key ] );
		}
	}

	static function get( $key ) {
		if( isset( $_SESSION[ CSession::generateSessionKey( $key ) ] ) ) {
			return  $_SESSION[ CSession::generateSessionKey( $key ) ];
		}else {
			return false;
		}
	}

	static function set( $strKey, $strValue, $ttl = 0 ) {
		$_SESSION[ CSession::generateSessionKey( $strKey ) ] = $strValue;
		if( $ttl != 0 ) {
			$strValue = json_encode( $strValue );
		}
		setcookie(
			CSession::generateSessionKey( $strKey ),
			$strValue,
			( time() + $ttl ),
			'/',
			$_SERVER[ 'HTTP_HOST' ]
			);
	}

	static function kill( $key ) {
		if( isset( $_SESSION[ CSession::generateSessionKey( $key ) ] ) ) {
			unset( $_SESSION[ CSession::generateSessionKey( $key ) ] );
		}
		if( isset( $_COOKIE[ $_SESSION[ CSession::generateSessionKey( $key ) ] ] ) ) {
			setcookie(
				$_SESSION[ CSession::generateSessionKey( $key ) ],
				'',
				time() - 5000,
				'/',
				$_SERVER[ 'HTTP_HOST' ]
			);
		}
	}

	static function endSession() {
		foreach ( $_SESSION as $key => $value ) {
			unset( $_SESSION[ $key ] );
		}
		foreach ( $_COOKIE as $key => $value ) {
			setcookie(
				$key,
				'',
				time() - 5000,
				'/',
				$_SERVER[ 'HTTP_HOST' ]
			);
		}
	}

	static function generateSessionKey( $key ) {
		$strAppend = $GLOBALS[ 'config' ][ 'appName' ];
		$strVersion = $GLOBALS[ 'config' ][ 'version' ];
		return md5( $key . $strAppend . $strVersion );
	}

}
