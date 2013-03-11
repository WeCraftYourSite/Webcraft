<?php
/**
 * app_dev.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

session_start();

require_once dirname( dirname( __FILE__ ) ) ."/lib/config/website.php";
require_once dirname( dirname( __FILE__ ) ) ."/lib/autoload.php";

if ( $_SERVER['REMOTE_ADDR'] == "127.0.0.1" || $_SERVER['REMOTE_ADDR'] == "::1" ) {
	// Cal router
	$router = new Router();
	$router->listen();
	$router->listen( 'secondary' );
}
else {
	echo "You must change to production mode";
}

