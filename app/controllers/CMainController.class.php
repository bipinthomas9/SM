<?php

class CMainController extends CBaseController {

	function index() {
		$arrAssets = array(
			'logo'	=> 'assets/img/logo.png'
		);
		$arrLoadFiles = array(
			[
				'name'		=> 'head',
				'extension'	=> '.php',
				'directory'	=> 'template/'
			],
			[
				'name'		=> 'index',
				'extension'	=> '.php',
				'directory'	=> 'main/'
			],
			[
				'name'		=> 'foot',
				'extension'	=> '.php',
				'directory'	=> 'template/'
			]
		);
		CLoadView::getView( $arrLoadFiles, $arrAssets );
	}

}