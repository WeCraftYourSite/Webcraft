<?php
/**
 * Router.php
 *
 * This file is part of Webcraft
 * All rights reserved
 *
 * @author Romain Quilliot <romain.addweb@gmail.com>
 **/

class Router {

	private $globalRoutes;
	private $priority;
	private $secondary;
	private $response;
	private $state = array(
		"priority" => false,
		"secondary" => false
	);

	public function __construct ( ) {
		$routeFile = file_get_contents( SystemConfig::get( 'lib' ) ."/ressource/routes.json" );
		$this->globalRoutes = json_decode( $routeFile );
		//var_dump( $this->globalRoutes );exit;
		$this->priority = $this->globalRoutes->priority;
		$this->secondary = $this->globalRoutes->secondary;
		$this->response = new Response();
	}

	public function listen ( $level = "priority" ) {

		$error = true;
		$Routes = $this->$level;

		if ( $level == "secondary" && $this->state['priority'] == false || $level == "priority") {
			
			for ( $i=0; $i < count( $Routes ); $i++ ) {
			
				$routeFile = SystemConfig::get( 'root' ) . $Routes[$i];
				
				if ( $Routing = $this->parse( $routeFile ) ) {

					$ControllerPath = SystemConfig::get( 'app' ) ."/". $Routing['bundle'] ."/controller/". $Routing['controller'] .".php";

					if ( !file_exists( $ControllerPath ) ) {
						$this->response->error('404');
					}

					require_once $ControllerPath;

					$instance = new $Routing['controller']();

					if ( !method_exists( $Routing['controller'], $Routing['action'] ) ) {
						$this->response->error('404');
					}

					$this->response->setSystem( 'bundle', $Routing['bundle'] );
					$this->response->setSystem( 'controller', $Routing['controller'] );
					$this->response->setSystem( 'action', $Routing['action'] );

					call_user_func_array(array($instance, $Routing['action']), array());

					$error = false;
					$this->state[$level] = true;
				}
			}
		}

		if ( $level == "secondary" && $this->state['secondary'] == false && $this->state['priority'] == false ) {
			$this->response->error('404');
		}
	}

	public function parse ( $routeFile ) {

		if ( !file_exists( $routeFile )) {
			return false;
		}

		$routeContent = file_get_contents( $routeFile );
		$routeContent = json_decode( $routeContent );

		foreach ( $routeContent AS $key => $value ) {

			if ( preg_match("`^". $value->url ."$`", SystemConfig::get( 'urlparse' ), $matches) ) {

				$bundle = explode('_', $key);
				$controller = explode(':', $value->controller);

				if ( isset( $value->vars ) ) {

					$vars = explode( ',', $value->vars );
					foreach ( $matches AS $key => $value ) {

						if ( $key != 0 ) {
							$this->response->set('get', $vars[$key - 1], $value);
						}
					}

				}

				return array (
					"bundle" => $bundle[0],
					"controller" => $controller[0],
					"action" => $controller[1]
				);
			}

		}
	}

}