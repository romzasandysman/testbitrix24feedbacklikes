<?php

use Bitrix\Main\ORM\Loader;

include 'main.php';
foreach (glob(__DIR__ . '/controllers/*.php') as $include) {
    /** @noinspection PhpIncludeInspection */
    include $include;
}

foreach (glob(__DIR__ . '/tables/*table.php') as $include) {
    /** @noinspection PhpIncludeInspection */
    include_once $include;
}

foreach (glob(__DIR__ . '/tables/*.php') as $include) {
    /** @noinspection PhpIncludeInspection */
    include_once $include;
}

Loader::autoLoad('\\My\\Tables\\EO_Like');
Loader::autoLoad('\\My\\Tables\\EO_Like_Collection');

if (!\My\Controllers\LikeController::isTableInstaled()){
    My\Controllers\LikeController::installTable();
}