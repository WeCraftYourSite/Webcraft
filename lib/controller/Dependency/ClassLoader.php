<?php
/**
 * ClassLoader.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

class ClassLoader {

	private $dependencyContent;
	private $includedController;

	public function __construct () {
		spl_autoload_register(
			array(
				$this,
				"Autoload"
			)
		);

		$dependencyFile = file_get_contents( dirname(dirname(dirname( __FILE__ ))) ."/ressource/dependency.json" );
		$this->dependencyContent = json_decode( $dependencyFile );
		//var_dump( $this->dependencyContent );
	}

	public function Autoload ( $className ) {

		if ( !isset( $this->includedController[$className] ) ) {
			if ( $this->is( $className ) ) {
				
				if ( $this->isFile( $className ) ) {
					require_once SystemConfig::get( 'root' ) . $this->dependencyContent->require->$className;
					$this->includedController[$className];
				} else {
					echo "Error dependency file no exists";
				}

			}
		}
	}

	public function is ( $className ) {

		if ( isset( $this->dependencyContent->require->$className ) ) {
			return true;
		}

	}

	public function isFile ( $className ) {

		if ( file_exists( SystemConfig::get( 'root' ) . $this->dependencyContent->require->$className ) ) {
			return true;
		}
	}

}