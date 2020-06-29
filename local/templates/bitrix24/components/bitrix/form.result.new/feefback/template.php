<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<div class="modal-header">
    <h5 class="modal-title">
    <?php
    if ($arResult["isFormTitle"]){
        echo $arResult["FORM_TITLE"];
    }
    ?>
    </h5>
    <?
    if ($arResult["isFormImage"] == "Y") {
        ?>
        <a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>">
            <img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" />
        </a>
        <?
    }
    ?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php echo $arResult["FORM_HEADER"]?>
    <div class="modal-body">
        <p><?=$arResult["FORM_DESCRIPTION"]?></p>
        <?if (is_array($arResult["FORM_ERRORS"])):?>
            <div class="alert alert-danger" role="alert">
                <?foreach ($arResult["FORM_ERRORS"] as $FIELD_SID => $error):?>
                    <div><?php echo htmlspecialcharsbx($error)?></div>
                <?php endforeach?>
            </div>
        <?endif;?>
        <?php if ($arResult['FORM_NOTE']):?>
            <div class="alert alert-success" role="alert">
                <?php echo $arResult["FORM_NOTE"]?>
            </div>
        <?php endif?>
        <?
        foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
            if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
                echo $arQuestion["HTML_CODE"];
            }
            else {?>
            <div class="form-group">
                <label>
                    <?=$arQuestion["CAPTION"]?>
                </label>
                <?if ($arQuestion["REQUIRED"] == "Y"):?>
                    <?=$arResult["REQUIRED_SIGN"];?>
                <?endif;?>
                <?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
                <?=str_replace('class="','class="form-control ', $arQuestion["HTML_CODE"])?>
            </div>
        <?}
        } ?>
        <? if($arResult["isUseCaptcha"] == "Y"){?>
                <div class="form-group">
                   <b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b>
                </div>
                <div class="form-group">
                    <label for="captcha_sid">&nbsp;</label>
                    <div>
                        <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="captcha_word"><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></label>
                    <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="form-control" />
                </div>
        <?}?>
        <p>
            <?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
        </p>
        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:main.userconsent.request",
            "",
            Array(
                "AUTO_SAVE" => "Y",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "ID" => "1",
                "IS_CHECKED" => "Y",
                "IS_LOADED" => "N"
            )
        );
        ?>
    </div>
    <div class="modal-footer">
        <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" class="btn btn-primary" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo GetMessage("FORM_CLOSE")?></button>
    </div>
<?=$arResult["FORM_FOOTER"]?>
