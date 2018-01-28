<?php

class CErrorHandler {

	static function showError( $strErrorType ) {
		$arrAssets = [
			'img'	=> $GLOBALS[ 'config' ][ 'domain' ] . CCommon::PATH_ASSETS_IMG_FOLDER . 'page_not_found.jpg'
		];
		$arrLoadFiles = [
			[
				'name'		=> 'pagenotfound',
				'extension'	=> '.php',
				'directory'	=> 'main/'
			],
		];
		CLoadView::getView( $arrLoadFiles, $arrAssets );
	}

}