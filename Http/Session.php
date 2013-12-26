<?php
class yapf_Http_Session
{

    public static function getParam($param)
    {
        if (isset($_SESSION[$param])) {
            return $_SESSION[$param];
        }
        return false;
    }

    public static function setParam($param, $value)
    {
        $_SESSION[$param] = $value;
    }

    public static function clearParam($param)
    {
        unset($_SESSION[$param]);
    }

    public static function start()
    {
        session_start();
    }

    public static function destroy()
    {
        session_destroy();
        session_start();
    }
}

?>