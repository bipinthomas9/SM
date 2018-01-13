<?php


class CLoadView {

	static function getView( $arrLoadFiles, $viewVars = array() ) {
		extract( $viewVars );

		$strAppDirectory = $GLOBALS[ 'config' ][ 'path' ][ 'app' ];
		foreach ( $arrLoadFiles as $file ) {
			$strFilePath = '';
			switch ( $file[ 'type' ] ) {
				case '.css':
					$strFilePath .= $strAppDirectory . 'libs/' . str_replace( '::', '/', $file[ 'directory' ] ) . $file[ 'name' ] . $file[ 'type' ];
					echo '<link rel="stylesheet" href=' . $strFilePath . ' type="text/css">';
					break;
				case '.js':
					$strFilePath .= $strAppDirectory . 'libs/' . str_replace( '::', '/', $file[ 'directory' ] ) . $file[ 'name' ] . $file[ 'type' ];
					echo '<script src=' . $strFilePath . '></script>';
					break;
				case '.php':
					$strFilePath .= $strAppDirectory . 'views/' . str_replace( '::', '/', $file[ 'directory' ] ) . $file[ 'name' ] . $file[ 'type' ];
					require_once $strFilePath;
					break;
			}
		}
	}
}