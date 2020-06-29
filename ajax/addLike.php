<?php
include 'stopstatic.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

use \Bitrix\Main\Web\Json,
    My\Controllers\LikeController;

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$ip = $request->get('ip');
$itemId = $request->get('itemID');

if (!$ip || !$itemId){
    echo Json::encode(['success' => false, 'message' => 'empty request data']);
    die();
}

if (LikeController::isIpHasLikeOnItem($ip, $itemId)){
    echo Json::encode(['success' => false, 'message' => 'ip has like']);
    die();
}

$result = LikeController::insertRow($ip, $itemId, true);

if ($result->isSuccess()){
    echo Json::encode(['success' => true, 'count' => LikeController::getCountLikesByItem($itemId)]);
}else{
    echo Json::encode(['success' => false, 'message' => $result->getErrorMessages()]);
}
die();