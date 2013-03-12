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

		return $this->request->get( 'SESSION', $name.'.token' );

	}
}