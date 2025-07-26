<?php

declare(strict_types=1);

namespace Adventofcode\Day6\utils;

use Adventofcode\Day6\utils\Query;


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
        $pregematch = preg_match($this->convertRouteToRegex($path), $this->baseURL);

        if ($pregematch) {
            $params = $this->GetQueryParams($path);
            $callback($params);
        }
    }

    public function Middleware()
    {
        return $this;
    }

    /**
     * Render a View
     * @param string $path
     * @param array|null $data
     * @return void
     */
    public static function View(string $path, ?array $data = []): void
    {
        require_once dirname(__DIR__, 1) . "/" . "view" . "/" . $path . ".php";
        return;
    }


    /**
     * Get the Querry Params
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

function dd($dump): void
{
    echo "<pre>";
    var_dump($dump);
    die();
    echo "</pre>";
}
