<?php

use Service\Router\Router;

Router::regRoute('/test', 'App\Controllers\Base|run');