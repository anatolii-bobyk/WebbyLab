<?php

class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @param $path
     * @param $controllerMethod
     * @return void
     */
    public function addRoute($path, $controllerMethod)
    {
        $this->routes[$path] = $controllerMethod;
    }

    /**
     * @return void
     */
    public function handleRequest()
    {
        $path = $_SERVER['REQUEST_URI'];
        if (isset($this->routes[$path])) {
            $controllerMethod = $this->routes[$path];
            $controllerMethod();
        } else {
            echo "404 - Page Not Found";
        }
    }

}
