<?php
/**
 * SystemConfig.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

class SystemConfig {

	public static function set ( $key, $value ) {
		$key = strtoupper ( $key );

		define ( $key, $value );
	}

	public static function get ( $key ) {
		$key = strtoupper ( $key );

		if ( SystemConfig::is( $key ) ) {
			return get_defined_constants ( true )['user'][$key];
		}
	}

	public static function is ( $key ) {
		$key = strtoupper ( $key );

		if ( @defined( $key ) ) {
			return true;
		}
	}

}