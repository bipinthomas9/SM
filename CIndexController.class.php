<?php

require_once( 'CBaseController.class.php' );

class CIndexController extends CBaseController {

	public function __construct() {
		parent::__construct();
	}

	public function start() {
		parent::start();
		echo "Start";
	}
    
}


