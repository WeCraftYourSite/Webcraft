<?php
/**
 * autoload.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

require_once SystemConfig::get( 'lib' ) ."/controller/Dependency/ClassLoader.php";

$classLoader = new ClassLoader();