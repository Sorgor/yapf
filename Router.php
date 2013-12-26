<?php

class yapf_Router
{

    public function __construct($route = null)
    {
        $config = yapf_Config::getConfig();

        $this->routes = $config->readArray('routing');

        $this->routeArray = array();
        $this->controller = $config->read('application', 'defaultController');
        if ($route) {
            $routeArray = $this->explodeRoute($route);
            for ($i = 0; $i < count($routeArray); $i++) {
                if ($routeArray[$i] === "") {
                    unset($routeArray[$i]);
                }
            }
            $this->routeArray = $routeArray;
        }
    }

    public function parseRoute($params = array())
    {
        if ($this->routeArray) {
            $controller = array_shift($this->routeArray);
            if ($controller) {
                for ($i = 0; $i < count($this->routeArray); $i++) {
                    yapf_Http_Request::set($this->routes[$controller][$i], $this->routeArray[$i]);
                    $params[$this->routes[$controller][$i]] = $this->routeArray[$i];
                }
                $this->controller = $controller;
            }
        }
        $this->params = $params;
    }

    public function explodeRoute($route)
    {
        return explode('/', $route);
    }
}