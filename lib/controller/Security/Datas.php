<?php
/**
 * Datas.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

class SecurityDatas {

	public function escape ( $unsafe ) {

	}

	public function encode ( ) {

	}

	public function encrypt ( $uncrypt, $token = true ) {
		if ( $token == true ) {
			$uncryptOne = sha1( $uncrypt.rand( '83', '82342497' ) );
		} else {
			$uncryptOne = sha1( $uncrypt.SystemConfig::get( 'hash' ) );
		}
		$uncryptTwo = md5( $uncryptOne.SystemConfig::get( 'hash' ) );
		$uncrypt = substr($uncryptOne, 4, 20) . substr( $uncryptTwo, 10, 36);

		return $uncrypt;
	}

}