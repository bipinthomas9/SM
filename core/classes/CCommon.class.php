<?php

class CCommon {

	const IS_DELETED = 1;
	const IS_NOT_DELETED = 0;
	const PATH_ASSETS_IMG_FOLDER = 'assets/img/';

	static function isLoggedIn() {
		$arrstrCheck = [
			'id', 'username', 'firstname', 'lastname'
		];

		return ( CSession::check( $arrstrCheck ) ? true : false );
	}
}