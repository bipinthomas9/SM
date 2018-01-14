<?php


class CLoadView {

	static function getView( $arrLoadFiles, $viewVars = array() ) {
		extract( $viewVars );

		$strAppDirectory = $GLOBALS[ 'config' ][ 'path' ][ 'app' ];
		foreach ( $arrLoadFiles as $file ) {
			$strFilePath = '';
			switch ( $file[ 'extension' ] ) {
				case '.css':
					$strFilePath .= $strAppDirectory . 'libs/' . $file[ 'directory' ] . $file[ 'name' ] . $file[ 'extension' ];
					echo '<link rel="stylesheet" href=' . $strFilePath . ' extension="text/css">';
					break;
				case '.js':
					$strFilePath .= $strAppDirectory . 'libs/' . $file[ 'directory' ] . $file[ 'name' ] . $file[ 'extension' ];
					echo '<script src=' . $strFilePath . '></script>';
					break;
				case '.php':
					$strFilePath .= $strAppDirectory . 'views/' . $file[ 'directory' ] . $file[ 'name' ] . $file[ 'extension' ];
					require_once $strFilePath;
					break;
			}
		}
	}
}