<?php
/**
 * Csrf.php
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
 * Csrf is a controller which protect system of CSRF attacks
 * @author 		Romain Quilliot <romain.addweb@gmail.com>
 **/
class Csrf {

	/**
	 * Response is an instance of Response()
	 **/
	private $response;
	/**
	 * Request is an instance of Request()
	 **/
	private $request;

	/**
	 * Class constructor
	 **/
	public function __construct ( ) {
		$this->response = new Response();
		$this->request = new Request();
	}

	/**
	 * To create a user token
	 * @param 	string 	( name of token )
	 * @param 	string  ( action which autorize token )
	 * @param 	int 	( time which token expire )
	 **/
	public function setToken ( $name, $action, $expire ) {
		$token = sha1( time().rand(87,27683) );
		$this->response->set( 'SESSION', $name.'.token', array(
			'token' 	=> $token,
			'action'	=> $action,
			'expire'	=> time() + $expire
		));
	}

	/**
	 * To get a token
	 * @param 	string 	( name of token )
	 * @return 	array
	 **/
	public function getToken ( $name ) {

		return $this->request->exists( 'session', $name.'.token' );

	}

	/** 
	 * To verify if a token is valid
	 * @param 	string 	( name of token )
	 * @param 	string 	( action of token )
	 * @return 	boolean
	 **/
	public function verifyToken ( $name, $action ) {

		if ( !$this->getToken( $name ) ) {
			return false;
		}

		$token = $this->request->fetch( 'session', $name.'.token' );
		if ( $token['action'] != $action ) {
			return false;
		}

		if ( $token['expire'] < time() ) {
			return false;
		}

		return true;
	}
}