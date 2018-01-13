<?php

require_once( 'CBaseController.class.php' );

class CIndexController extends CBaseController {

	protected $m_objClass;

	public function __construct() {
		parent::__construct();
	}

	public function init() {
		parent::init();
		$this->start();
	}

	public function start() {
		parent::start();
		$this->getClassObject()->start();
	}

	public function getClassObject() {
		return new CHomePageController();
	}

    public function setClassObject( $objClass ) {
		$this->m_objClass = $objClass;
    }

}


