<?php

class yapf_Locale{
    protected $currentLocale = 'ru';
    protected static $instance;

    protected function __construct(){}

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function setLocale(yapf_Locale_Lang $lang){
        $this->lang = $lang;
    }

    public function getVar($var){
        if(isset($this->lang->localization[$var])){
            return $this->lang->localization[$var];
        }
        else{
            return $var;
        }
    }
}