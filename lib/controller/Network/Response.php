<?php
/**
 * Response.php
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
 * Response is an object to set datas send to client
 * @author 		Romain Quilliot <romain.addweb@gmail.com>
 **/
class Response {

	/**
	 * Differents http status codes
	 **/
	private $status = array(
		"200" => "200 OK",
		"201" => "201 Created",
		"202" => "202 Accepted",
		"203" => "203 Non-Authoritative Information",
		"204" => "204 No Content",
		"205" => "205 Reset Content",
		"206" => "206 Partial Content",
		"300" => "300 Multiple Choices",
		"301" => "301 Moved Permanently",
		"302" => "302 Found",
		"303" => "303 See Other",
		"304" => "304 Not Modified",
		"305" => "305 Use Proxy",
		"307" => "307 Temporary Redirect",
		"400" => "400 Bad Request",
		"401" => "401 Unauthorized",
		"402" => "402 Payment Required",
		"403" => "403 Forbidden",
		"404" => "404 Not Found",
		"405" => "405 Method Not Allowed",
		"406" => "406 Not Acceptable",
		"407" => "407 Proxy Authentication Required",
		"408" => "408 Request Timeout",
		"409" => "409 Conflict",
		"410" => "410 Gone",
		"411" => "411 Length Required",
		"412" => "412 Precondition Failed",
		"413" => "413 Request Entity Too Large",
		"414" => "414 Request-URI Too Long",
		"415" => "415 Unsupported Media Type",
		"416" => "416 Requested Range Not Satisfiable",
		"417" => "417 Expectation Failed",
		"500" => "500 Internal Server Error",
		"501" => "501 Not Implemented",
		"502" => "502 Bad Gateway",
		"503" => "503 Service Unavailable",
		"504" => "504 Gateway Timeout",
		"505" => "505 HTTP Version Not Supported"
	);
	
	/**
	 * Set a system data
	 * @param 	string 	( system key data )
	 * @param 	string 	( system value data )
	 **/
	public function setSystem ( $key, $value ) {
		$_SERVER['WebCraftRequest'][$key] = $value;
	}

	/**
	 * Set a superglobal data
	 * @param 	string 	( superglobal )
	 * @param 	string 	( superglobal key )
	 * @param 	string 	( superglobal value )
	 **/
	public function set( $method, $key, $value ) {
		$method = strtoupper( $method );

		if ( $method == "GET" ) {
			$_GET[$key] = $value;
		} else if ( $method == "POST" ) {
			$_POST[$key] = $value;
		} else if ( $method == "COOKIE" ) {
			setcookie( $key, $value );
		} else if ( $method == "SESSION" ) {
			$_SESSION[$key] = $value;
		}
	
	}

	/**
	 * Define Content type
	 * @param 	string 	( content type )
	 **/
	public function type ( $type ) {
		header ( 'Content-type: '. $type );
	}

	/** 
	 * Define header
	 * @param 	string 	( header )
	 **/
	public function header ( $header ) {
		header ( $header );
	}

	/**
	 * Redirect user
	 * @param 	string 	( page link )
	 **/
	public function location ( $link ) {
		header ( 'Location: '. $link );
		exit;
	}

	/**
	 * To download file from server
	 * @param 	string 	( name )
	 * @param 	string 	( path )
	 * @param 	string 	( extension )
	 * @param 	string 	( size )
	 **/
	public function download ( $name, $path, $extension, $size = '0' ) {
		header("application/force-download; name='$name'");
		header("Content-Length: $size" );
		header("Content-disposition: attachment; filename='". $name .".". $extension ."'");
		readfile( SystemConfig::get( 'root' ) ."/". $path );
	}

	/**
	 * Set status code 
	 * @param 	string 	( status code )
	 **/
	public function status ( $statusCode ) {
		header ( 'HTTP/1.0 '. $this->status[$statusCode] );
	}

	/**
	 * To display an error 
	 * to add or change error template 
	 * go to /lib/ressource/view/errors/
	 * @param 	string 	( status code )
	 **/
	public function error ( $status ) {
		$this->status( $status );
		require_once SystemConfig::get( 'lib' ) ."/ressource/view/errors/". $status .".view";
		exit;
	}

}