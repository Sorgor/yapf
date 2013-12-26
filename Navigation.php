<?php 

class yapf_Navigation {
    
    private static $instance;

    static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function __construct() {
        $this->urls = yapf_Config::getConfig()->readArray('navigation');
    }
    
    public function getUrl($nav, array $params = array()){
        $url = $this->urls[$nav];
        if(count($params)>0){
            for($i=1;$i<=count($params);$i++){
                $url = str_replace("$".$i, $params[$i-1], $url);
            }
        }
        return yapf_Config::getConfig()->read('application', 'baseHost') . $url;
    }
}