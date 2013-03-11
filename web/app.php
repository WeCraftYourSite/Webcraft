<?php
/**
 * app.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

session_start();

require_once dirname( dirname( __FILE__ ) ) ."/lib/config/website.php";
require_once dirname( dirname( __FILE__ ) ) ."/lib/autoload.php";

// Cal router
$router = new Router();
$router->listen();
$router->listen( 'secondary' );