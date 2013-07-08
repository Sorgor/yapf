<?php

class defaultController extends yapf_Controller implements yapf_Interface_Runnable
{
    public function __init()
    {

    }

    public function defaultAction()
    {
        echo 'output by defaultController:';

        $model = yapf_Model::getInstance('defaultModel');

        echo '<br>' . $model->test() . '<br>';

        $this->template->loadTemplate('default.tpl')->display(array());
    }
}
