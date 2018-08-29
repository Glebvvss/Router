<?php

namespace Service\Router;

class RouterFacade {

	public static function init() {
		return new Router();
	}

	public static function __callStatic( $method, $arguments ) {
		$router = new Router();

		if ( empty($arguments) ) {
			return $router->$method();
		}
		
		return $router->$method( join(',', $arguments) );
	}

}