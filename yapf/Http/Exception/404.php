<?php
/**
 *
 */
class yapf_Http_Exception_404 extends yapf_Http_Exception
{
    public function render(){
        yapf_Http_Response::getInstance()->setHeader(yapf_Http_Response::HTTP_NOT_FOUND)->sendResponse();
        die(yapf_Template::getEngine('twig')->loadTemplate('errors/404.tpl')->render(array()));
    }
}