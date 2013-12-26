<?php

class yapf_Db_Mysql
{
    protected $dbh = null;
    protected $db  = null;
    protected $stmt = null;

    protected static $instance;

    public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    protected function __construct()
    {
        $connectionParams = yapf_Config::getConfig()->readArray('database', 'mysql');
        $this->dbh = new PDO("mysql:host={$connectionParams['host']};charset=utf8", $connectionParams['user'], $connectionParams['pass']);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(!empty($connectionParams['db'])){
            $this->dbh->query('use '.$connectionParams['db']);
        }
    }

    public function insert($table, $bindParams = array())
    {
        if (!array($bindParams)) {
            throw new Exception('yapf_DB: wrong data for insert');
        }
        try {
            $fields = array();
            $placeholders = array();
            foreach ($bindParams as $key => $value) {
                $fields[] = $key;
                $placeholders[] = ':' . $key;
            }
            $insertStmt = $this->dbh->prepare("INSERT INTO $table (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholders) . ")");
            $insertStmt->execute($bindParams);
            return $this->lid();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($table, $bindParams = array(), $where = '')
    {
        if (!array($bindParams)) {
            throw new Exception('yapf_DB: wrong data for update');
        }
        try {
            if (strlen($where) > 0) $where = 'WHERE ' . $where;
            $placeholders = array();
            foreach ($bindParams as $key => $value) {
                $placeholders[] = $key . ' = ' . ':' . $key;
            }
            $insertStmt = $this->dbh->prepare("UPDATE $table SET " . implode(',', $placeholders) . " $where ");
            return $insertStmt->execute($bindParams);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function select($table, $fetch = '*', $where = '', $limit = '', $offset = '')
    {
        $values = array();
        if (strlen($where) > 0) $where = 'WHERE ' . $where;
        if (strlen($limit) > 0) $limit = 'LIMIT ' . $limit;
        $selectStmt = $this->dbh->prepare("SELECT $fetch FROM $table $where $limit");

        $selectStmt->execute($values);
        return $selectStmt->fetch(PDO::FETCH_ASSOC);
    }

    public function prepare($q){
        $this->stmt = $this->dbh->prepare($q);
        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $this;
    }

    public function bindArray($bindParams) {
        foreach ($bindParams as $param => $value) {
            if(is_int($value)){
                $this->stmt->bindValue($param, $value, PDO::PARAM_INT);
            }
            else{
                $this->stmt->bindValue($param, $value);
            }
        }
        return $this;
    }
    public function bindParams($bindParams) {
        foreach ($bindParams as $param => $value) {
            if(is_int($value)){
                $this->stmt->bindValue($param, $value, PDO::PARAM_INT);
            }
            else{
                $this->stmt->bindValue($param, $value);
            }
        }
        return $this;
    }

    public function execute(){
        $this->stmt->execute();
        return $this->stmt;
    }

    public function lid(){
        return $this->dbh->lastInsertId();
    }
}