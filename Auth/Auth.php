<?php

class yapf_Auth_Auth {

    static $User;

    public static function __initSession(){
        $User = yapf_Http_Session::getParam('User');
        if($User){
            self::setUser($User);
            return $User;
        }
        else{
            return false;
        }
    }

    public static function getUser(){
        return self::$User;
    }

    public static function setUser($User){
        yapf_Http_Session::setParam('User', $User);
        self::$User = $User;
    }
}