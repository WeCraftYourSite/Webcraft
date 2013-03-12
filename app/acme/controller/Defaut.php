<?php
/**
 * Defaut.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

class Defaut extends AppController{

	public function index ( ) {
		/*$this->render( 'index.view', array(
			'username' => $this->request->fetch( 'get', 'name' )
		));*/
		//echo $this->securityDatas->encrypt('dede', false);
		//$this->csrf->setToken( 'test', 'Default:index', 7 );

		if ( $this->csrf->verifyToken( 'test', 'Default:index' ) ) {
			echo "ok";
		} else {
			echo "Erreur";
		}
	}

}