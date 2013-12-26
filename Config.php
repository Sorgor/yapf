<?php

class yapf_Config
{
    // TODO: если идет обращение к несуществующей секции или директиве, кидать исключение

    protected static $config;

    protected $routing;

    protected $application;

    protected function __construct()
    {

    }

    public static function getConfig()
    {
        if (!self::$config) {
            self::$config = new self;
        }
        return self::$config;
    }

    public function read($section, $directive = null)
    {
        if (!empty($directive)) {
            return $this->{$section}->$directive;
        }
        else {
            return $this->{$section};
        }
    }

    public function readArray($section, $directive = null){
        if (!empty($directive)) {
            return (array) $this->{$section}->$directive;
        }
        else {
            return (array) $this->{$section};
        }
    }

    public function parseArray(array $arrayConfig)
    {
        foreach ($arrayConfig as $section => $directives) {
            $this->$section = new yapf_Config_Section($directives);
        }
    }

    public function parseJson($jsonConfig)
    {
        $arrayConfig = json_decode($jsonConfig, true);
        $this->parseArray($arrayConfig);
    }
}

// TODO: реализовать интерфейс Iterator, ArrayAccess

class yapf_Config_Section implements ArrayAccess //implements Iterator
{
    public function __construct($section)
    {
        foreach ($section as $directive => $value) {
            $this->$directive = $value;
        }
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}