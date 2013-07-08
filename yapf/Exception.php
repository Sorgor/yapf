<?php

class yapf_Exception extends Exception
{
    public function __construct($message = "", $code = 0){

        $this->config = yapf_Registry::get('config');

        parent::__construct($message, $code);
    }
}