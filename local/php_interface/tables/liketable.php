<?php
namespace My\Tables;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;

class LikeTable extends DataManager
{
    public static function getObjectClass()
    {
        return Like::class;
    }

    public static function getCollectionClass()
    {
        return Likes::class;
    }

    public static function getMap()
    {
        return [
            (new IntegerField('ID'))->configurePrimary()->configureAutocomplete(),
            (new StringField('LIKE')),
            (new StringField('DISLIKE')),
            (new StringField('ID_ITEM'))->configureRequired(),
            (new StringField('IP'))->configureRequired()->configureUnique(),
        ];
    }
}