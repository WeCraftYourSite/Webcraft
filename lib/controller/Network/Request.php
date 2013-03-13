<?php
/**
 * Request.php
 *
 * This file is part of WebCraft
 * 
 * Licensed under The MIT License
 * For more information read the file LICENSE.txt
 *
 * @author 		Romain Quilliot <romain.addweb@gmail.com>
 * @copyright	Copyright (c) WeCraftYourSite (http://wecraftyoursite.com)
 * @package		WebCraft
 * @version 	v 1.1
 * @license 	MIT License
 **/

/**
 * Request is an object to get datas sent by the client
 * @author 		Romain Quilliot <romain.addweb@gmail.com>
 **/
class Request {

	/**
	 * Get system information
	 * @param 	string 	( data will be got )
	 * @return 	array 	
	 **/
	public function getSystem ( $key = null ) {
		if ( $key != null ) {
			return $_SERVER['WebCraftRequest'][$key];
		} 
		else {
			return $_SERVER['WebCraftRequest'];
		}
	}

	/**
	 * Fetch data from superglobals
	 * @param 	string 	( superglobal )
	 * @param 	string 	( key wich contain data wanted )
	 * @return  string
	 **/
	public function fetch ( $method, $key ) {
		$method = strtoupper( $method );

		if ( $method == "GET" ) {
			return $_GET[$key];
		} else if ( $method == "POST" ) {
			return $_POST[$key];
		} else if ( $method == "COOKIE" ) {
			return $_COOKIE[$key];
		} else if ( $method == "SESSION" ) {
			return $_SESSION[$key];
		}
	}

	/**
	 * Verify if a data exists in superglobal
	 * @param 	string 	( superglobal )
	 * @param 	string 	( key which contain data wanted )
	 * @return 	boolean
	 **/
	public function exists ( $method, $key ) {
		$method = strtoupper( $method );

		if ( $method == "GET" ) {
			return isset( $_GET[$key] ) ? true : false;
		} else if ( $method == "POST" ) {
			return isset( $_POST[$key] ) ? true : false;
		} else if ( $method == "COOKIE" ) {
			return isset( $_COOKIE[$key] ) ? true : false;
		} else if ( $method == "SESSION" ) {
			return isset( $_SESSION[$key] ) ? true : false;
		}
	}

	/**
	 * Get method sent by the navigator
	 * @return 	string
	 **/
	public function method ( ) {
		return $_SERVER['REQUEST_METHOD'];
	}

	/**
	 * To know if current request is an Ajax Request
	 * @return 	boolean
	 **/
	public function isAjax ( ) {
		if ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ) {
			$httpRequest = strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] );

			if ( $httpRequest == 'xmlhttprequest' ) {
				return true;
			}
		}
	}

	/**
	 * To get request time begin
	 * @return 	float
	 **/
	public function time ( ) {
		return $_SERVER['REQUEST_TIME_FLOAT'];
	}
}