<?php
/**
 * Request.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

class Request {

	public function getSystem ( $key = null ) {
		if ( $key != null ) {
			return $_SERVER['WebCraftRequest'][$key];
		} 
		else {
			return $_SERVER['WebCraftRequest'];
		}
	}

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

	public function method ( ) {
		return $_SERVER['REQUEST_METHOD'];
	}

	public function time ( ) {
		return $_SERVER['REQUEST_TIME_FLOAT'];
	}
}