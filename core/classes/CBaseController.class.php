<?php 

class CBaseController {
	
	public function __construct() {
		$GLOBALS[ 'instances' ][]	= &$this;
	}
	
	public function init() {}
	
	public function create() {}
	
	public function start() {}
	
	public function execute() {}
	
	public function finalize() {}
	
	public function destroy() {}
	
}