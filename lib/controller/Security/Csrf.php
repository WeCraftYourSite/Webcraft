<?php
/**
 * Csrf.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

class Csrf {

	private $response;
	private $request;

	public function __construct ( ) {
		$this->response = new Response();
		$this->request = new Request();
	}

	public function setToken ( $name, $action, $expire ) {
		$token = sha1( time().rand(87,27683) );
		$this->response->set( 'SESSION', $name.'.token', array(
			'token' 	=> $token,
			'action'	=> $action,
			'expire'	=> time() + $expire
		));
	}

	public function getToken ( $name ) {

		return $this->request->exists( 'session', $name.'.token' );

	}

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