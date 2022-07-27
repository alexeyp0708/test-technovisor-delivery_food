<?php

namespace App\Alpa\Food\models;
use App\Alpa\Core\ModelTrait;
use Yii;
//use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Provider  extends ActiveRecord
{
    
    use ModelTrait;
    /**
     * @property int|null $id;
     * @property string $name;
     * @property bool $is_enabled=true;
     */



    public static function tableName()
    {
        return '{{food_providers}}';
    }
    
 

    public function rules()
    {
        return [
            [['id'],'number'],
            [['name', 'is_enabled'], 'required'],
        ];
    }
    /*    public function behaviors()
        {
            return [
                TimestampBehavior::class,
            ];
        }*/
    public static function getProviderList():array
    {
        return static::find()->where(['deleted_at'=>null])->all(); 
    }
    
    public static function addProvider(string $name, bool $is_enabled=true):Provider
    {
        $provider=new static();
        $provider->name=$name;
        $provider->is_enabled=$is_enabled;
        if(!$provider->save()){
            throw new ErrorException('Failed to save');
        };
        return $provider;
    }
    
    public static function updateProvider(int $id,string $name, bool $is_enabled=true):?Provider
    {
        $provider=new static();
        $provider->id=$id;
        $provider->name=$name;
        $provider->is_enabled=$is_enabled;
        if(!$provider->save()){
            return null;
        };
        return $provider;
    }

    /**
     * @param int $id
     * @return \App\Alpa\Food\models\Provider|null
     */
    public static function getProvider(int $id):?Provider
    {
        $provider= static::find()->where(['id'=>$id,'deleted_at'=>null])->one();
        if(empty($provider)){
            return null;
        }
        return $provider;
    }
    
    public static function deleteProvider(int $id):bool
    {
        return (bool)Yii::$app->db
            ->createCommand()
            ->update(static::tableName(), ['deleted_at'=>new Expression('NOW()')],['id'=>$id])
            ->execute();
    }
    
    public function forceDeleteProvider(int $id):bool
    {
        return (bool)Yii::$app->db
            ->createCommand()
            ->delete($this->tableName(),['id'=>$id])
            ->execute();
    }
}