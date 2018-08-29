<?php 

namespace Service\Router;

class RouterFactory {

	public static final function factory( $classController, $methodController ) {
		if ( !$classController || !$methodController ) {
			throw new Exception('Incorrect class or method of controller.');
		}

		$objectController = new $classController;
		return $objectController->$methodController();
	}

}