<?php

use App\Controllers\Api\MaponApiController;
use App\Controllers\ErrorController;
use App\Controllers\HomeController;
use App\Controllers\TransactionController;
use Core\Routing\Router;

Router::add('/', HomeController::class, "actionIndex", Router::METHOD_GET);

Router::add('/transactions', TransactionController::class, "actionIndex", Router::METHOD_GET);
Router::add('/save-transactions', TransactionController::class, "actionHandleTransactionUpload", Router::METHOD_POST);

Router::add('/mapon-historical-data', MaponApiController::class, "actionRetrieveHistoricalData", Router::METHOD_GET);

Router::setRouteNotFoundHandler(ErrorController::class, "handleRouteNotFound");