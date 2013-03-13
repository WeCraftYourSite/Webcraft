<?php
/**
 * AppController.php
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
 * AppController is parent of all modules controllers
 * @author 		Romain Quilliot <romain.addweb@gmail.com>
 **/
class AppController {

	/**
	 * Response is an instance of Response() 
	 **/
	protected $response;
	/**
	 * Request is an instance of Request() 
	 **/
	protected $request;
	/**
	 * SecurityDatas is an instance of SecurityDatas()
	 **/
	protected $securityDatas;
	/**
	 * Csrf is an instance of Csrf()
	 **/
	protected $csrf;
	/**
	 * Twig is an instance of Twig_Environment()
	 **/
	protected $twig;

	/**
	 * Class constructor
	 **/
	public function __construct() {

		require_once SystemConfig::get( 'lib' ). "/vendor/twig/Autoloader.php";
		Twig_Autoloader::register();

		$this->response = new Response();
		$this->request = new Request();
		$this->securityDatas = new SecurityDatas();
		$this->csrf = new Csrf();
		$loader = new Twig_Loader_Filesystem( SystemConfig::get( 'root' ) );
		$this->twig = new Twig_Environment($loader);

	}

	/**
	 * Display a view
	 * @param 	string 	( name of view file )
	 * @param 	array 	( variables )
	 **/
	public function render ( $file, $vars = array() ) {
		echo $this->twig->render( "/app/". $this->request->getSystem( 'bundle' ) ."/view/". $file, $vars);
	}

}