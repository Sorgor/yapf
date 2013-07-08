<?php

class yapf_Dispatcher {
    private static $instances = array();

    public static function dispatch($router, $app = 'application') {
        try
        {
            $controller = self::getController($router->controller.'Controller', $app);
            if (!($controller instanceof yapf_Interface_Runnable) )
                throw new yapf_Http_Exception_404();
        }
        catch (yapf_Http_Exception_404 $exc) {
            $exc->render();
        }
    }

    public static function getController($controller, $app = 'application'){
        if(in_array($controller,self::$instances)){
            return self::$instances[$controller];
        }
        else {
            if (!file_exists(get_include_path() . $app . "/controllers/$controller.php")){
                throw new yapf_Http_Exception_404();
            }
            else {
                include_once $app . "/controllers/$controller.php";
            }
            self::$instances[$controller] = new $controller;
        }
        return self::$instances[$controller];
    }
}