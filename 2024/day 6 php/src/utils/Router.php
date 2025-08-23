<?php

declare(strict_types=1);

namespace Adventofcode\Day6\utils;



use JetBrains\PhpStorm\NoReturn;

class Router
{
    public string $baseURL;

    function __construct(string $baseURL)
    {
        $this->baseURL = $baseURL;
    }

    /**
     * Get the Request Method
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function Get(string $path, callable $callback): void
    {
        $regExCh = preg_match($this->convertRouteToRegex($path), $this->baseURL);

        if ($regExCh) {
            $params = $this->GetQueryParams($path);
            $callback($params);
        }
    }

    public function Middleware(): static
    {
        return $this;
    }

    /**
     * Render a View
     * @param string $path
     * @return void
     */
    public static function View(string $path): void
    {
        // check if it is a file or a directory
        $filePath = dirname(__DIR__) . "/" . "View" . "/" . $path;
        if (is_dir($filePath)) {
            $filePath .= "/index.php";
        } else {
            $filePath .= ".php";
        }
        require_once $filePath;
    }


    /**
     * Get the Query Params
     * @param string $path
     * @return Query[]
     */
    public function GetQueryParams(string $path): array
    {
        $params = [];
        $paths = explode("/", $path);
        $baseURL = array_filter(explode("/", $this->baseURL), fn($value) => !empty($value));


        if (count($baseURL) !== 0) {
            foreach ($paths as $key => $value) {
                $paramPos = strpos($value, ":");

                if ($paramPos !== false) {
                    $params[] = new Query($value, $baseURL[$key] ?? '');
                }
            }
        }

        return $params;
    }

    /**
     * Converts a route string with :placeholders to a complete regular expression.
     * * Example: '/day/:id' becomes '/^\/day\/([^\/]+)$/'
     * *
     * * @param string $route The friendly route string.
     * * @return string The completed regular expression.
     */
    private function convertRouteToRegex(string $route): string
    {
        // 1. Replace all occurrences of :placeholder with a regex capture group.
        // Many routers use ([^/]+) which means "match one or more characters that are NOT a slash".
        // This will also make /day/:id/edit work.
        $pattern = preg_replace('/:[a-zA-Z0-9_]+/', '([^/]+)', $route);

        // 2. Add start and end characters (^ and $) to ensure that the entire URL matches.
        // We use a character other than / as a delimiter (here #) to avoid escaping all the slashes.
        return '#^' . $pattern . '$#';
    }
}

/**
 * Prints variabels readable
 * @param $dump
 * @return void
 */
#[NoReturn]
function dd($dump): void
{
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
    die();
}
