<?php
/**
 * Datas.php
 *
 * This file is part of Webcraft
 * 
 * Licensed under The MIT License
 * For more information read the file LICENSE.txt
 *
 * @author 		Romain Quilliot <romain.addweb@gmail.com>
 * @copyright	Copyright (c) WeCraftYourSite (http://wecraftyoursite.com)
 * @package		Webcraft
 * @version 	v 1.1
 * @license 	MIT License
 **/

/**
 * SecurityDatas protect and encode strings
 * @author 		Romain Quilliot <romain.addweb@gmail.com>
 **/
class SecurityDatas {

	/**
	 * Escape a string unsafe
	 * @param 	string 	( string unsafe )
	 * @param 	string
	 **/
	public function escape ( $unsafe ) {
		$unsafe = htmlspecialchars( trim( stripcslashes( $unsafe ) ) );
		return $unsafe;
	}

	/**
	 * Escape a string unsafe for a mysql request
	 * @param 	string 	( string unsafe )
	 * @return 	string
	 **/
	public function mysqlEscape ( $unsafe ) {
		$unsafe = "";
	}

	/**
	 * Encrypt a string unsafe
	 * @param 	string 	( uncrypt string )
	 * @param 	boolean ( if it's a token )
	 * @return 	string
	 **/
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