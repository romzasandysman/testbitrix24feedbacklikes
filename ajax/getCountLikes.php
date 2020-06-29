<?php
include 'stopstatic.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

use \Bitrix\Main\Web\Json,
    My\Controllers\LikeController;

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$arItemsId = Json::decode($request->get('itemsID'));

if (!$arItemsId){
    echo Json::encode(['success' => false, 'message' => 'empty request data']);
    die();
}

$arNewArItemsId = [];
foreach ($arItemsId as $itemId){
    $arNewArItemsId[$itemId] = [
        'ID' => $itemId
    ];
}


echo Json::encode(['success' => true, 'data_count' => LikeController::getItemsWithLikesData($arNewArItemsId)]);

die();