<?php
/**
 * RoutingException.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

class RoutingException {

	public function __construct( $message ) {

		die ( $message );

	}

}