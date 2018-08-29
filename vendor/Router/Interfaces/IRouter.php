<?php 

namespace Service\Router\Interfaces;

interface IRouter {

	public static function regRoute( string $routeTpl, string $controller );

}