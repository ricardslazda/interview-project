<?php

declare(strict_types=1);

namespace App\Controllers;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ErrorController {
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    function handleRouteNotFound() {
        renderTemplate('404.html');
    }
}