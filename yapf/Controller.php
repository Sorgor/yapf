<?php

abstract class yapf_Controller implements yapf_Interface_Runnable
{

    /**
     * @var string $modelName
     */
    protected $modelName = false;

    public function __construct()
    {
        $this->request = new yapf_Http_Request();

        $this->template = yapf_Template::getEngine('twig');

        if ($this->modelName) {
            $this->model = yapf_Model::getInstance($this->modelName);
        }

        $this->__init();

        $action = yapf_Http_Request::get('action');

        if (method_exists($this, $action . 'Action')) {
            $methodName = $action . 'Action';
            $this->$methodName();
        } else {
            $this->defaultAction();
        }

    }

}