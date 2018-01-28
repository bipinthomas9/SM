<?php

class CMainController extends CBaseController {

	function index() {

		$arrLoadFiles = [
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
		];
		CLoadView::getView( $arrLoadFiles );
	}

}