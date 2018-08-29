<?php

require_once 'vendor/autoload.php';

use Service\Router\RouterFacade;
use Service\Router\Router;

RouterFacade::init()
	->addSourceRoutes('app/Routes/Main.php')
	->run();