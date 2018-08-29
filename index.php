<?php

require_once 'vendor/autoload.php';

use Service\Router\RouterFacade;

RouterFacade::init()
	->setRootDirectory( $_SERVER['DOCUMENT_ROOT'] . '/app/Routes' )
	->addSourceRoutes('Main.php')
	->run();