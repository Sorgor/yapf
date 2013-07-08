<?php

require_once('../bootstrap.php');

try {
    $router = new yapf_Router(yapf_Http_Request::get('route'));

    $router->parseRoute();

    yapf_Dispatcher::dispatch($router, 'application');

} catch (Exception $exc) {
    yapf_Http_Response::getInstance()->setHeader(yapf_Http_Response::HTTP_SERVER_ERROR)->sendResponse();
    try {
        die(yapf_Template::getEngine('twig')->loadTemplate('errors/500.tpl')->render(array('message' => $exc)));
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}