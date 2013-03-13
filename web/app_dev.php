<?php
/**
 * app_dev.php
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

session_start();

require_once dirname( dirname( __FILE__ ) ) ."/lib/config/website.php";
require_once dirname( dirname( __FILE__ ) ) ."/lib/autoload.php";

if ( $_SERVER['REMOTE_ADDR'] == "127.0.0.1" || $_SERVER['REMOTE_ADDR'] == "::1" ) {
	
	Config::set( 'devmode', true );
	
	$router = new Router();
	$router->listen();
	$router->listen( 'secondary' );
}
else {
	echo "You must change to production mode";
}

