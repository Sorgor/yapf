<?php

class yapf_Http_Exception extends yapf_Exception
{
    public function render(){
        die('<pre>' . $this . '</pre>');
    }
}