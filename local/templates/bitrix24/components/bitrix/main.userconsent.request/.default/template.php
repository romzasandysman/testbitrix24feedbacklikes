<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */

$config = \Bitrix\Main\Web\Json::encode($arResult['CONFIG']);
Bitrix\Main\Localization\Loc::loadLanguageFile(__FILE__);
?>
<label data-bx-user-consent="<?=htmlspecialcharsbx($config)?>" class="main-user-consent-request">
	<input type="checkbox" value="Y" <?=($arParams['IS_CHECKED'] ? 'checked' : '')?> name="<?=htmlspecialcharsbx($arParams['INPUT_NAME'])?>">
	<span class="main-user-consent-request-announce"><?=htmlspecialcharsbx($arResult['INPUT_LABEL'])?>
	    <?php echo Bitrix\Main\Localization\Loc::getMessage('MAIN_USER_CONSENT_REQUEST_PAGE', ['URL' => $arResult['URL']])?></span>
</label>