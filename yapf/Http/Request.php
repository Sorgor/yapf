<?php

class yapf_Http_Request
{
    static function get($param){
        if ($_REQUEST) {
            if (isset($_REQUEST[$param])) {
                return $_REQUEST[$param];
            }
            else {
                return false;
            }
        }
        return false;
    }

    static function getInt($param){
        if ($_REQUEST) {
            if (isset($_REQUEST[$param])) {
                return intval($_REQUEST[$param]);
            }
            else {
                return false;
            }
        }
        return false;
    }

    static function post($param){
        if ($_POST) {
            if (isset($_POST[$param])) {
                return $_POST[$param];
            }
            else {
                return false;
            }
        }
        return false;
    }

    static function set($param, $value){
        $_REQUEST[$param] = $value;
        return true;
    }

    static function fetchGetParams(){
        if($_GET){
            foreach ($_GET as $key=>$value) {
                $params[$key] = $value;
            }
            return $params;
        }
    }

    static function fetchPostParams(){
        if(!empty($_POST)){
            foreach ($_POST as $key=>$value) {
                $params[$key] = $value;
            }
            return $params;
        }
        return false;
    }
}
