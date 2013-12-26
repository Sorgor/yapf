<?php

class yapf_Parser_Ini implements yapf_Interface_Parser
{
    protected $parsed;

    protected $sections = array();

    public function __construct($filePath){
        $this->parsed = parse_ini_file($filePath, true);

        foreach ($this->parsed as $section => $values) {
            $this->sections[] = $section;
        }
    }

    public function getSections(){
        return $this->sections;
    }

    public function getSection($section){
        return $this->parsed[$section];
    }

    public function fromSection($section, $varName){
        if (!in_array($section, $this->sections)) {
            return false;
        }

        if (isset($this->parsed[$section][$varName])) {
            return $this->parsed[$section][$varName];
        }

        return false;
    }
}