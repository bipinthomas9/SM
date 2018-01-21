<?php

class CCommon {

	static function isLoggedIn() {
		$arrstrCheck = [
			'id', 'username', 'firstname', 'lastname'
		];

		return ( CSession::check( $arrstrCheck ) ? true : false );
	}
}