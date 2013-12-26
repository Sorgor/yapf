<?php

class yapf_Db_Mongo
{
    private static $connection = false;

    protected function __construct(){
        $config = yapf_Config::getConfig()->read('mongo');

        $db = $config->db;

        try{
            $this->mongo = new Mongo();
            $this->mongodb = $this->mongo->$db;
        }
        catch(MongoConnectionException $exc){
            die($exc->getMessage());
        }

    }

    public static function getConnection(){
        if(!self::$connection){
            self::$connection = new self;
        }
        return self::$connection;
    }
}