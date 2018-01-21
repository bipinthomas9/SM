<?php

class CAdmins extends CModel{

	function auth( $username, $password ) {
		$this->m_objDatabaseModel->executeQuery(
			'SELECT 
						*
					 FROM 
					 	`admins` 
					WHERE 
						`username` = ? 
						AND 
						`password` = ?
						AND 
						`deleteFlag` = ?
						',
			array( $username, $password, 0 )
		);

		if( $row = $this->m_objDatabaseModel->fetch_assoc() ) {
			return $row;
		}else {
			return false;
		}

	}
}
