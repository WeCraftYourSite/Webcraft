<?php
/**
 * Defaut.php
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

class Defaut extends AppController{

	public function index ( ) {
		/*$this->render( 'index.view', array(
			'username' => $this->request->fetch( 'get', 'name' )
		));*/
		//echo $this->securityDatas->encrypt('dede', false);
		//$this->csrf->setToken( 'test', 'Default:index', 7 );

		
	}

}