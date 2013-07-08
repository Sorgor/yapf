<?php

class yapf_Template_Twig
{
    protected $engine;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(yapf_Config::getConfig()->read('application', 'templateRoot'));
        $twig = new Twig_Environment($loader, yapf_Config::getConfig()->readArray('twig'));

        $this->engine = $twig;

        $this->engine->addFunction('_', new Twig_Function_Function('yapf_Template_Function::_'));
        $this->engine->addFunction('_n_rus', new Twig_Function_Function('yapf_Template_Function::_n_rus'));
    }

    public function getEngine()
    {
        return $this->engine;
    }
}