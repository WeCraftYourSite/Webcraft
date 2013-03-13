<?php
/**
 * SystemConfig.php
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
 * SystemConfig set and get some usefull datas
 * @author 	Romain Quilliot <romain.addweb@gmail.com>
 **/
class SystemConfig {

	/**
	 * To set a config data
	 * @param 	string 	( key of config data )
	 * @param 	string 	( value of config data )
	 **/
	public static function set ( $key, $value ) {
		$key = strtoupper ( $key );

		define ( $key, $value );
	}

	/**
	 * To get a config data
	 * @param 	string 	( key of config data )
	 * @param 	string
	 **/
	public static function get ( $key ) {
		$key = strtoupper ( $key );

		if ( SystemConfig::is( $key ) ) {
			return get_defined_constants ( true )['user'][$key];
		}
	}

	/**
	 * To know if a config data exists
	 * @param 	string 	( key of config data )
	 * @return 	boolean
	 **/
	public static function is ( $key ) {
		$key = strtoupper ( $key );

		if ( @defined( $key ) ) {
			return true;
		}
	}

}