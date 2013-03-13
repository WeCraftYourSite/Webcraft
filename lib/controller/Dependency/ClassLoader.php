<?php
/**
 * ClassLoader.php
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
 * ClassLoader load automatically controllers
 * @author 	Romain Quilliot <romain.addweb@gmail.com>
 **/
class ClassLoader {

	/**
	 * DependencyContent contain content of dependency.json file
	 **/
	private $dependencyContent;
	/**
	 * IncludedController contain controller already included
	 **/
	private $includedController;

	/**
	 * Class constructor to register Autoload method
	 **/
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

	/** 
	 * Autoload is method which load controllers
	 * @param 	string 	( class name )
	 **/
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

	/**
	 * To know if class exists in dependency.json file
	 * @param 	string 	( class name )
	 * @return 	boolean
	 **/
	public function is ( $className ) {

		if ( isset( $this->dependencyContent->require->$className ) ) {
			return true;
		}

	}

	/**
	 * To know if the file which contain the class exists
	 * @param 	string 	( class name )
	 * @return 	boolean
	 **/
	public function isFile ( $className ) {

		if ( file_exists( SystemConfig::get( 'root' ) . $this->dependencyContent->require->$className ) ) {
			return true;
		}
	}

}