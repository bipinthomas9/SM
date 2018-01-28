<?php 

class CBaseController {

	public function __construct() {
		$GLOBALS[ 'instances' ][]	= &$this;
		self::init();
	}

	public function init() {
		$arrAssets = [
			'logo'	=>  $GLOBALS[ 'config' ][ 'domain' ] . $GLOBALS[ 'config' ][ 'logo' ]
		];
		$arrLoadFiles = array(
			[
				'name'		=> 'bootstrap',
				'extension'	=> '.css',
				'directory'	=> 'bootstrap/css/'
			],
			[
				'name'		=> 'jquery',
				'extension'	=> '.js',
				'directory'	=> 'jquery/'
			],
			[
				'name'		=> 'bootstrap',
				'extension'	=> '.js',
				'directory'	=> 'bootstrap/js/'
			],
			[
				'name'			=> 'head',
				'extension'		=> '.php',
				'directory'		=> 'template/'
			],
		);
		CLoadView::getView( $arrLoadFiles, $arrAssets );
	}
	
	public function create() {}
	
	public function start() {}
	
	public function execute() {}
	
	public function finalize() {}
	
	public function destroy() {}
	
}