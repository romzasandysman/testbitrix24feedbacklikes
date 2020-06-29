<?php
include 'stopstatic.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
global $APPLICATION;
$APPLICATION->ShowAjaxHead();

$APPLICATION->IncludeComponent("bitrix:form.result.new","feefback", Array(
        "SEF_MODE" => "N",
        "WEB_FORM_ID" => "1",
        "LIST_URL" => "",
        "EDIT_URL" => "",
        "SUCCESS_URL" => "",
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "Y",
        "USE_EXTENDED_ERRORS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "0",
        "SEF_FOLDER" => "/",
    )
);
die();
