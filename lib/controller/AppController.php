<?php
/**
 * AppController.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

class AppController {

	protected $response;
	protected $request;
	protected $securityDatas;
	protected $twig;

	public function __construct() {

		require_once SystemConfig::get( 'lib' ). "/vendor/twig/Autoloader.php";
		Twig_Autoloader::register();

		$this->response = new Response();
		$this->request = new Request();
		$this->securityDatas = new SecurityDatas();
		$loader = new Twig_Loader_Filesystem( SystemConfig::get( 'root' ) );
		$this->twig = new Twig_Environment($loader);

	}

	public function render ( $file, $vars = array() ) {
		echo $this->twig->render( "/app/". $this->request->getSystem( 'bundle' ) ."/view/". $file, $vars);
	}

}