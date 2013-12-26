<?php

abstract class yapf_Model{

    protected $table = false;

    private static $instances = array();

    public static function getInstance($model)
    {
        if (in_array($model, self::$instances)) {
            return self::$instances[$model];
        }
        else {
            $result = include_once APPLICATION . "/models/$model.php";
            if ($result === false)
                throw new yapf_Http_Exception_500('Model not found');

            self::$instances[$model] = new $model;
        }
        return self::$instances[$model];
    }
}