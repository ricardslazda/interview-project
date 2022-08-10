<?php

namespace Core\Routing;

class Router
{
    const METHOD_GET = "get";
    const METHOD_POST = "post";

    private const EXPRESSION_KEY = "expression";
    private const CONTROLLER_KEY = "controller";
    private const FUNCTION_KEY = "function";
    private const METHOD_KEY = "method";

    private static array $routes = [];
    private static array $routeNotFoundHandler = [];

    public static function setRouteNotFoundHandler(string $controller, string $method): void
    {
        self::$routeNotFoundHandler = [
            self::CONTROLLER_KEY => $controller,
            self::FUNCTION_KEY => $method,
        ];
    }

    public static function add(string $expression, string $controller, string $function, string $method): void
    {
        self::$routes[] = [
            self::EXPRESSION_KEY => $expression,
            self::CONTROLLER_KEY => $controller,
            self::FUNCTION_KEY => $function,
            self::METHOD_KEY => $method,
        ];
    }

    public static function run(): void
    {
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        $path = $parsed_url['path'] ?? '/';

        $method = $_SERVER['REQUEST_METHOD'];
        $path_match_found = false;
        $route_match_found = false;

        foreach (self::$routes as $route) {
            $route[self::EXPRESSION_KEY] = '^' . $route[self::EXPRESSION_KEY];
            $route[self::EXPRESSION_KEY] = $route[self::EXPRESSION_KEY] . '$';

            if (preg_match('#' . $route[self::EXPRESSION_KEY] . '#', $path, $matches)) {
                $path_match_found = true;

                if (strtolower($method) == strtolower($route[self::METHOD_KEY])) {
                    array_shift($matches);

                    $controller = new $route[self::CONTROLLER_KEY];
                    $controller->{$route[self::FUNCTION_KEY]}(...$matches);

                    $route_match_found = true;

                    break;
                }
            }
        }

        if (!$route_match_found) {
            if ($path_match_found) {
                header("HTTP/1.0 405 Method Not Allowed");
            } else {
                header("HTTP/1.0 404 Not Found");
            }

            $controller = new self::$routeNotFoundHandler[self::CONTROLLER_KEY];
            $controller->{self::$routeNotFoundHandler[self::FUNCTION_KEY]}();
        }
    }
}