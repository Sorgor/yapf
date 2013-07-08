<?php

class yapf_Xml_Parser
{
    var $xmlData;

    public function __construct(){

    }

    public function fromFile($filename){
        $this->xmlData = simplexml_load_file($filename);
        return $this->xmlData;
    }


    public function fromUrl($url){
        $this->xmlData = simplexml_load_string(file_get_contents($url));
        return $this->xmlData;
    }
}