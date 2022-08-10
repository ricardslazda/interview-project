<?php

use Core\Routing\Router;

require_once('vendor/autoload.php');
require_once('core/env.php');
require_once('core/helpers.php');
require_once('core/Routing/Routes.php');

Router::run();