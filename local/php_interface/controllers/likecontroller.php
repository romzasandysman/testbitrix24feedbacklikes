<?php
namespace My\Controllers;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Error;
use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\SystemException;
use Bitrix\Sender\Entity\Ad;
use Bitrix\Seo\Engine\Bitrix;

use My\Main;
use My\Tables\LikeTable;

class LikeController
{
    public static function isTableInstaled() : bool
    {
        return \Bitrix\Main\Application::getConnection()->isTableExists(LikeTable::getTableName());
    }

    public static function installTable() : bool
    {
        try {
            LikeTable::getEntity()->createDbTable();
        } catch (ArgumentException $e) {
            return false;
        } catch (SystemException $e) {
            return false;
        }

        return true;
    }

    public static function getItemsWithLikesData(array $arItems) : array
    {
        if (!$arItems) return  $arItems;

        $arItemsIds = [];
        $ip = Main::getIp();

        foreach ($arItems as $arItem){
            $arItemsIds[] = $arItem['ID'];
        }

        if ($arLikes = self::getArrItemsWhichHasLikesOrDisLikes($arItemsIds)){
            foreach ($arLikes as $arLike){
                if ($arItems[$arLike['ID_ITEM']]){
                    $arItem = &$arItems[$arLike['ID_ITEM']];

                    if ($arLike['IP'] == $ip){
                        $arItem['HAS_LIKE_FROM_USER'] = true;
                        $arItem['CHOOSE_LIKE'] = !empty($arLike['LIKE']);
                    }

                    if ($arLike['LIKE']) {
                        $arItem['COUNT_LIKES'] = $arItem['COUNT_LIKES'] ? $arItem['COUNT_LIKES'] + 1 : 1;
                    }else{
                        $arItem['COUNT_DIS_LIKES'] = $arItem['COUNT_DIS_LIKES'] ? $arItem['COUNT_DIS_LIKES'] + 1 : 1;
                    }
                }
            }
        }

        return  $arItems;
    }

    public static function insertRow(string $ip, string $idItem, bool $like) : AddResult
    {
        $return = new AddResult();

        if (!$ip) {
            $return->addError(new Error('empty ip'));
            return $return;
        }

        if (!$idItem) {
            $return->addError(new Error('empty id item'));
            return $return;
        }

        $objCreate = LikeTable::createObject();
        $objCreate->setIp($ip);
        $objCreate->setIdItem($idItem);

        if ($like){
            $objCreate->setLike('Y');
        }else{
            $objCreate->setDisLike('Y');
        }

        return $objCreate->save();
    }

    public static function getCountLikesByItem(string $idItem)
    {
        if (!$idItem){
            throw new \Error('not enough params');
        }

        return count(LikeTable::getList(['filter' => ['!LIKE' => '', 'ID_ITEM' => $idItem]])->fetchAll());
    }

    public static function getCountDisLikesByItem(string $idItem)
    {
        if (!$idItem){
            throw new \Error('not enough params');
        }

        return count(LikeTable::getList(['filter' => ['!DISLIKE' => '', 'ID_ITEM' => $idItem]])->fetchAll());
    }

    public static function isIpHasLikeOnItem(string $ip, string $idItem) : bool
    {
        if (!$ip || !$idItem){
            throw new \Error('not enough params');
        }

        return count(self::getListOfLikesByIpItems($ip, [$idItem])->fetchAll()) > 0;
    }

    public static function getArrItemsWhichHasLikesOrDisLikes(array $arIdItems) : array
    {
        if (!$arIdItems){
            throw new \Error('not enough params');
        }

        return self::getListOfLikesByItems($arIdItems)->fetchAll();
    }

    private static function getListOfLikesByItems(array $idItem)
    {
        return LikeTable::getList(['filter' => ['ID_ITEM' => $idItem]]);
    }

    private static function getListOfLikesByIpItems(string $ip, array $idItem)
    {
        return LikeTable::getList(['filter' => ['IP' => $ip, 'ID_ITEM' => $idItem]]);
    }
}