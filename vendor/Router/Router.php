<?php 

namespace Service\Router;

use Service\Router\Interfaces\IRouter;
use Service\Router\Interfaces\IRunner;
use Service\Router\Traits\TEscapingBackSlashesRegExp;
use \Exception;

class Router implements IRouter {

	use TEscapingBackSlashesRegExp;

	protected static $controllerSeparator 	   = '->';
	protected static $regExpOfGetParam         = '#~[a-zA-Z]+#';
	protected static $regExpOfOptionalGetParam = '#~[a-zA-Z]+;opt#';

	protected static $routeList;

	protected $rootDirectory;
	protected $currentRoute;

	public function __construct() {
		$this->rootDirectory = $_SERVER['DOCUMENT_ROOT'];
		$this->currentRoute = $_SERVER['REQUEST_URI'];
	}

	public function run() {
		if ( empty(self::$routeList) ) {
			return;
		}

		$controller = $this->getControllerByCurrentRoute();
		$assocController = $this->separateControllerOnClassAndMethod( $controller );
		RouterFactory::factory( $assocController['class'], $assocController['method'] );
	}

	public static function regRoute( string $routeTpl, string $controller ) {
		if ( self::$routeList !== null && array_key_exists( $route, self::$routeList ) ) {
			throw new Exception("Route {$route} is already taken.");
		}
		self::$routeList[$routeTpl] = $controller;
	}

	public function setRootDirectory( $nonDefaultRootDirectory ) {
		$this->rootDirectory = $nonDefaultRootDirectory;
		return $this;
	}

	public function addSourceRoutes( $pathToRegistrationRoutesFile ) {
		include_once $this->rootDirectory . '/' . $pathToRegistrationRoutesFile;
		return $this;
	}

	protected function getControllerByCurrentRoute() {
		$routeTpl = $this->findRegistredRouteTplByCurrentRoute();
		return self::$routeList[$routeTpl];
	}

	protected function separateControllerOnClassAndMethod( $controller ) {
		(array) $controller = explode(self::$controllerSeparator, $controller);

		if ( count($controller) !== 2 ) {
			throw new Exception('Incorrect controller name by route');
		}

		(array) $assocController = [
			'class'  => $controller[0],
			'method' => $controller[1]
		];
		return $assocController;
	}

	protected function findRegistredRouteTplByCurrentRoute() {
		foreach ( self::$routeList as $registratedRouteTpl => $registratedController ) {
			$searchPattern = $this->makeSearchPatternByRouteTpl( $registratedRouteTpl );
			if ( preg_match( '/^'.$searchPattern.'$/', $this->currentRoute ) ) {
				$this->takeGetTypeParamsByRoute( $registratedRouteTpl );
				return $registratedRouteTpl;
			}
		}
		throw new Exception('Incorrect route');
	}

	protected function makeSearchPatternByRouteTpl( string $registratedRouteTpl ) {
		$registratedRouteTpl = self::escapeBackSlashes( $registratedRouteTpl );
		return preg_replace( '/'.$this->makeRegExpForGetPrams().'/' , '([a-zA-Z0-9-]+|)', $registratedRouteTpl );
	}

	protected function takeGetTypeParamsByRoute( string $currentRouteTpl ) {
		$currentRoute = $this->currentRoute;
		$countParams = preg_match_all( '/'.$this->makeRegExpForGetParams().'/' , $currentRouteTpl, $attributes );

		$counter = 0;
		while( $counter < $countParams ) {
			$prefix = strstr( $currentRouteTpl, $attributes[0][$counter], true );

			$countSymbolsToCutFromStart = strlen($prefix) + strlen($attributes[0][$counter]);
			$currentRouteTpl            = substr( $currentRouteTpl, $countSymbolsToCutFromStart );
			$currentRoute               = substr( $currentRoute, strlen($prefix) );

			if ( ($counter + 1) == $countParams ) {
				if ( $currentRouteTpl != null ) {
					$paramValue = strstr( $currentRoute, $currentRouteTpl, true );	
				} else {
					$paramValue = $currentRoute;
				}
			} else {
				$postfix 	  = strstr( $currentRouteTpl, $attributes[0][$counter + 1], true );
				$paramValue   = strstr( $currentRoute, $postfix, true );
				$currentRoute = substr( $currentRoute, strlen($paramValue) );
			}

			$this->addGetParamToGlobalArray( $attributes[0][$counter], $paramValue );
			++$counter;
		}
	}

	private function makeRegExpForGetParams() {
		return '(' . self::$regExpOfGetParam . '|' . self::$regExpOfOptionalGetParam . ')';
	}

	private function addGetParamToGlobalArray(  $attribute, $value ) {
		$attribute = $this->removeSpecialSymbolsFromAttributes( $attribute );

		if ( $value ) {
			$_GET['Route'][$attribute] = $value;
		}
	}

	private function removeSpecialSymbolsFromAttributes( $attribute ) {
		if ( preg_match( self::$regExpOfOptionalGetParam, $attribute ) ) {
			return substr($attribute, 2, -5);
		}
		return substr($attribute, 2, -1);
	}
}
