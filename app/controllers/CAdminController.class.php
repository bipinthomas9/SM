<?php

class CAdminController extends CBaseController {

	function index() {

		$arrLoadFiles = [
			[
				'name'		=> 'adminlogin',
				'extension'	=> '.php',
				'directory'	=> 'admin/'
			],
		];
		if( CCommon::isLoggedIn() ) {
			CUrl::redirect( '/admin/home' );
		}else {
			if( CUrl::post( 'username' ) && CUrl::post( 'password' ) ) {
				$admins = new CAdmins();
				if( $user = $admins->auth( CUrl::post( 'username' ),
					CUrl::post( 'password' ) ) ) {
					CSession::set( 'username', $user[ 'username' ] );
					CSession::set( 'id', $user[ 'id' ] );
					CSession::set( 'firstname', $user[ 'firstname' ] );
					CSession::set( 'lastname', $user[ 'lastname' ] );
					CUrl::redirect( '/admin/home' );
				}else {
					CLoadView::getView( $arrLoadFiles );
				}
			}else {
				CLoadView::getView( $arrLoadFiles );
			}
		}
	}

	function doLogout() {
		CSession::endSession();
		CUrl::redirect('/');
	}



}