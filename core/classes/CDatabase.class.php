<?php

class CDatabase {

	private $m_objDatabase;
	private $m_result;

	public $m_strCurrentField	= '';
	public $m_strLengths		= '';
	public $m_intNumRows		= '';

	function __construct( $arrDatabaseCredentials , $objDatabase = NULL ) {
		if( is_null( $objDatabase ) ) {
			$this->m_objDatabase = new mysqli(
				$arrDatabaseCredentials[ 'host' ],
				$arrDatabaseCredentials[ 'username' ],
				$arrDatabaseCredentials[ 'password' ]
			);
		}else {
			$this->m_objDatabase = new mysqli(
				$arrDatabaseCredentials[ 'host' ],
				$arrDatabaseCredentials[ 'username' ],
				$arrDatabaseCredentials[ 'password' ],
				$objDatabase
			);
		}
	}

	function changeDatabase( $objDatabase ) {
		$this->m_objDatabase->select_db( $objDatabase );
	}

	function referenceValues( $arr ) {
		if( 0 <= strnatcmp( phpversion(), '5.3' ) ) {
			$strReference = array();
			foreach ( $strReference as $key => $value ) {
				$strReference[ $key ] = &$arr[ $key ];
			}
			return $strReference;
		}
		return $arr;
	}

	function executeQuery( $strQuery, $arrArguments = NULL ) {
		if( is_null( $arrArguments ) ) {
			$this->m_result				= $this->m_objDatabase->query( $strQuery );
			$this->m_intNumRows			= $this->m_result-> num_rows;
			$this->m_strLengths			= $this->m_result->lengths;
			$this->m_strCurrentField	= $this->m_result->current_field;
			return $this->m_result;
		}else {
			if( is_array( $arrArguments ) ) {
				$arrArgumentsCopy	= $arrArguments;
				$arrArguments		= array( $arrArgumentsCopy );
			}
			if( $strStatement = $this->m_objDatabase->prepare( $strQuery ) ) {
				$objDatatypes = '';
				foreach ( $arrArguments as $value ) {
					if( is_int( $value ) ) {
						$objDatatypes	.= 'i';
					}else if( is_double( $value ) ) {
						$objDatatypes	.= 'd';
					}else if( is_string( $value ) ) {
						$objDatatypes	.= 's';
					}else {
						$objDatatypes	.= 'b';
					}
				}
				array_unshift( $arrArguments, $objDatatypes );
				if( call_user_func_array( array( $strStatement, 'bind_param' ), $this->referenceValues( $arrArguments ) ) ) {
					$strStatement->execute();
					$this->m_result	= $strStatement->get_result();
					if( $this->m_result ) {
						$this->m_strCurrentField	= $this->m_result->current_field;
						$this->m_strLengths			= $this->m_result->lengths;
						$this->m_intNumRows			= $this->m_result->num_rows;
					}else {
						$this->m_strCurrentField	= '';
						$this->m_strLengths			= 0;
						$this->m_intNumRows			= 0;
					}
					return $this->m_result;
				}else {
					$this->m_strCurrentField	= '';
					$this->m_strLengths			= 0;
					$this->m_intNumRows			= 0;
					return false;
				}
			}else {
				$this->m_strCurrentField	= '';
				$this->m_strLengths			= 0;
				$this->m_intNumRows			= 0;
				return false;
			}
		}
	}

	function seekData( $intOffset = 0 ) {
		return $this->m_result->data_seek( $intOffset );
	}

	function fetch_all() {
		return $this->m_result->fetch_all();
	}

	function fetch_array() {
		return $this->m_result->fetch_array();
	}

	function fetch_assoc() {
		return $this->m_result->fetch_assoc();
	}

	function fetch_field_direct( $strField ) {
		return $this->m_result->fetch_field_direct( $strField );
	}

	function fetch_field() {
		return $this->m_result->fetch_field();
	}

	function fetch_fields() {
		return $this->m_result->fetch_fields();
	}

	function fetch_object( $strClassName = 'stdClass', $strParams = NULL ) {
		if( is_null( $strParams ) ) {
			return $this->m_result->fetch_object( $strClassName );
		}else {
			return $this->m_result->fetch_object( $strClassName, $strParams );
		}
	}

	function fetch_row(){
		return $this->m_result->fetch_row();
	}

	function field_seek( $strField ) {
		return $this->m_result->field_seek( $strField );
	}

	function insert_id() {
		return $this->m_result->insert_id();
	}

	function fetch_all_kv() {
		$arrOutput = array();
		while( $row = $this->m_result->fetch_assoc() ) {
			$arrOutput[]	= $row;
		}
		return $arrOutput;
	}

	function __destruct() {
		$this->m_objDatabase->close();
	}
}