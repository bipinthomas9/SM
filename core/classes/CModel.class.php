<?php

class CModel {

	public $m_objDatabaseModel;

	function __construct() {
		$this->m_objDatabaseModel = new CDatabase();
		$this->m_objDatabaseModel->connect(
			array(
				'host'		=> $GLOBALS[ 'config' ][ 'database' ][ 'host' ],
				'username'	=> $GLOBALS[ 'config' ][ 'database' ][ 'username' ],
				'password'	=> $GLOBALS[ 'config' ][ 'database' ][ 'password' ]
			), $GLOBALS[ 'config' ][ 'database' ][ 'name' ]
		);
	}

}