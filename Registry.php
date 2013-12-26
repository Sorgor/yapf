<?php

class yapf_Registry
{
    public static $registry = array();

    public static function get($var){
        if (isset(self::$registry[$var])) {
            return self::$registry[$var];
        }
        return false;
    }

    public static function set($var, $val){
        self::$registry[$var] = $val;
        return true;
    }
}