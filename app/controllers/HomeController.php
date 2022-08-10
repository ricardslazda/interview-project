<?php

declare(strict_types=1);

namespace App\Controllers;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController {
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    function actionIndex(): void
    {
        renderTemplate('home/index.html');
    }
}