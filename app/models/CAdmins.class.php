<?php

class CAdmins extends CModel{

	protected $strAdminFirstName;
	protected $strAdminLastName;

	function auth( $strUsername, $strPassword ) {
		$strQuery = "
			insert into admins values ( '','Joan','Rivers','joan123','jojo','' )
		";
		$selectQuery = 'SELECT * FROM admins WHERE username = ? AND password = ? AND deleteFlag = ?';

		$this->m_objDatabaseModel->executeQuery( $selectQuery, [ $strUsername, $strPassword, CCommon::IS_NOT_DELETED ] );
		return $row = $this->m_objDatabaseModel->fetch();
		var_dump( $row );
	}
}
