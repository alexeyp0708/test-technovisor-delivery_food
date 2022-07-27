<?php


namespace App\Alpa\Food\models;


use App\Alpa\Core\ModelTrait;
use Yii;
//use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;


class Menu extends ActiveRecord 
{
    use ModelTrait;
    public static function tableName()
    {
        return '{{food_providers}}';
    }

}