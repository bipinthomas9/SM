<?php 

class CBaseController {
	
	public function __construct() {
		$GLOBALS[ 'instances' ][]	= &$this;
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
			]
		);
		CLoadView::getView( $arrLoadFiles );
	}
	
	public function init() {}
	
	public function create() {}
	
	public function start() {}
	
	public function execute() {}
	
	public function finalize() {}
	
	public function destroy() {}
	
}