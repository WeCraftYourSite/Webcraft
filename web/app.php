<?php
/**
 * app.php
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

Config::set( 'devmode', false );

$router = new Router();
$router->listen();
$router->listen( 'secondary' );