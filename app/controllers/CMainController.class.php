<?php

class CMainController extends CBaseController {

	function index() {
		$arrLoadFiles = array(
			[
				'name'		=> 'bootstrap',
				'type'		=> '.css',
				'directory'	=> 'bootstrap::css::'
			],
			[
				'name'		=> 'jquery',
				'type'		=> '.js',
				'directory'	=> 'jquery::'
			],
			[
				'name'		=> 'bootstrap',
				'type'		=> '.js',
				'directory'	=> 'bootstrap::js::'
			],
			[
				'name'		=> 'index',
				'type'		=> '.php',
				'directory'	=> 'main::'
			]
		);
		CLoadView::getView( $arrLoadFiles, [] );
	}

}