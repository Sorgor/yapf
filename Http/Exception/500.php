<?php
/**
 *
 */
class yapf_Http_Exception_500 extends yapf_Http_Exception
{
    public function render(){
        yapf_Http_Response::getInstance()->setHeader(yapf_Http_Response::HTTP_SERVER_ERROR)->sendResponse();
        die(yapf_Template::getInstance($this->config)->loadTemplate('errors/500.tpl')->render(array('message' => $this->getMessage())));
    }
}
