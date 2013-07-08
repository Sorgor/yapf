<?php

date_default_timezone_set("Europe/Moscow");

define('DEBUG', true);
define('INTERVAL_WEEK', 604800);
define('INTERVAL_DAY', 86400);

define('APPLICATION', 'application');

set_include_path(realpath(dirname(__FILE__)) . "/");

require_once realpath(dirname(__FILE__)).'/../yapf/Autoload.php';

if($_SERVER['HTTP_HOST'] == 'devhost') {
    yapf_Config::getConfig()->parseJson(
        file_get_contents(__DIR__ . '/config/production.json')
    );
}
else {
    yapf_Config::getConfig()->parseJson(
        file_get_contents(__DIR__ . '/config/development.json')
    );
}

//setting locales
require_once 'languages/ru.php';

yapf_Locale::getInstance()->setLocale(new Lang_Ru());