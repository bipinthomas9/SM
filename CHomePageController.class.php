<?php

require_once( 'CIndexController.class.php' );

class CHomePageController extends CIndexController {

	public function init() {
		$this->setClassObject( new CHomePageController() );
	}

	public function start() {
		echo "Home Page";
	}

}