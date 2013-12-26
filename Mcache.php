<?php

class yapf_Mcache{

    private $defaultTime = 86400;

    public function __construct()
    {
        $config = yapf_Config::getConfig()->read('memcache');

        try {
            $this->memcache = new Memcache();
            $connected = $this->memcache->connect($config->host, $config->port);
            if (!$connected) {
                throw new yapf_Http_Exception('no memcache connection');
            }
        }
        catch (yapf_Http_Exception $e) {
            $e->render();
        }
    }

    /**
     * @param $key
     * @param $value
     * @param null $time
     * @return bool
     */
    public function set($key, $value, $time = null){
        if($time){
            return $this->memcache->set($key, $value, $time);
        }
        else{
            return $this->memcache->set($key, $value, $this->defaultTime);
        }
    }

    /**
     * @param $key
     * @return array|string
     */
    public function get($key){
        return $this->memcache->get($key);
    }

    public function inc($key){
        $this->memcache->increment($key);
    }

    public function del($key){
        $this->memcache->delete($key);
    }

    public function flush(){
        $this->memcache->flush();
    }

}