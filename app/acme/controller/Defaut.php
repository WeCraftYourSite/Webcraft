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
		$this->render( 'index.view', array(
			'username' => $this->request->fetch( 'get', 'name' )
		));
		//echo $this->securityDatas->encrypt('dede', false);
	}

}