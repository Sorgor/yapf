<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sorgor bulatabdullin@gmail.com
 * Date: 01.03.13
 * Time: 14:16
 */
class yapf_Http_Response
{
    const HTTP_NOT_FOUND = 'HTTP/1.1 404 Not Found';
    const HTTP_SERVER_ERROR = 'HTTP/1.1 500 Internal server error';
    const HTTP_REDIRECT = 'Location: ';

    private static $instance;
    private $header;
    private $errors = array();
    private $params = array();

    static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    static function doRedirect($location){
        self::getInstance()->setHeader(self::HTTP_REDIRECT, $location)->sendResponse();
    }

    public function sendResponse(){
        if ($this->header) {
            header($this->header);
        }
        else{
            $response = array();
            if(count($this->errors) > 0){
                $response['success'] = false;
                $response['errors'] = $this->errors;
            }
            else{
                $response['success'] = true;
            }
            $response['data']   = $this->params;
            die(json_encode($response));
        }
    }

    public function setError($error){
        if(empty($this->errors)){
            $this->errors[] = $error;
        }
        else{
            $this->errors[] = $error;
        }
        return $this;
    }

    public function setHeader($header, $headerContent = ''){
        $this->header = $header . $headerContent;
        return $this;
    }

    public function setParam($param, $value)
    {
        if (empty($this->params)) {
            $this->params[$param] = $value;
        }
        return $this;
    }

    public function setParams(array $params){
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    public function toCode(){
        echo '<pre>';
        print_r($this->params);
        echo '</pre>';
        exit;
    }
}