<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

function render($file, $variables = []): void
{
    ob_start();
    extract($variables);
    require(sprintf("app/views/%s", $file));

    echo ob_get_clean();
}

/**
 * @throws SyntaxError
 * @throws RuntimeError
 * @throws LoaderError
 */
function renderTemplate($template, $args = [])
{
    static $twig = null;

    if ($twig === null) {
        $loader = new FilesystemLoader(dirname(__DIR__) . '/app/views');
        $twig = new Environment($loader);
    }

    echo $twig->render($template, $args);
}

/**
 * @throws Exception
 */
function buildDateTime(string $date, string $time): DateTime
{
    return new DateTime(sprintf("%s %s", $date, $time));
}