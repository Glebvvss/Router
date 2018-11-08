<?php 

namespace Service\Router\Interfaces;

interface IRouter {

	public function run();
	
	public function setRootDirectory( $nonDefaultRootDirectory );
	
	public static function regRoute( string $routeTpl, string $controller );
	
	public function addSourceRoutes( $pathToRegistrationRoutesFile );

}
