<?php

class yapf_Template
{
    public static function getEngine($templateEngine){
        switch ($templateEngine) {
            case 'twig' :
                $tplInstance = new yapf_Template_Twig();

        }
        return $tplInstance->getEngine();
    }
}