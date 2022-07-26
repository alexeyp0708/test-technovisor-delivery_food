<?php


namespace App\Alpa\Food\models;


use yii\base\ErrorException;
use yii\db\ActiveRecord;

class Model extends ActiveRecord
{
    public function initPrimaryKeysForUpdate()
    {
        $check=$this->reflectEmptyPrimaryKeys();
        if(!$check){
            throw new ErrorException('Primary keys not initialized.');
        }
        return $this;
    }
    public function beforeSave($insert)
    {
        $check=$this->reflectForcePrimaryKeys();
        $this->reflectFields();
        $parent_check= parent::beforeSave($check?!$check:$insert); 
        return $check&&$parent_check;
    }
    public function afterSave($insert, $changedAttributes)
    {
        $this->backReflectFields();
        parent::afterSave($insert, $changedAttributes); 
    }
    public function beforeDelete()
    {
        $this->reflectFields();
        $check=$this->reflectEmptyPrimaryKeys();
        $parent_check=parent::beforeDelete();
        return $check&&$parent_check;
    }
    
    public function save($runValidation = true, $attributeNames = null)
    {
        $check=$this->reflectEmptyPrimaryKeys();
        return parent::save($runValidation, $attributeNames); 
    }

    public function afterRefresh()
    {
        $this->backReflectFields();
        parent::afterRefresh();
    }
    
    public function afterFind()
    {
        $this->backReflectFields();
        parent::afterFind();
    }

    /**
     * @return bool if true, If true, then all empty keys are updated and can be updated, otherwise not.
     */
    protected function reflectEmptyPrimaryKeys():bool
    {
        $primary_keys=static::primaryKey();
        $old_attributes=$this->getOldAttributes();
        $check=false;
        foreach($primary_keys as $key){
            if((!array_key_exists($key,$old_attributes) ||
                    is_null($old_attributes[$key]) ||
                    $this->hasAttribute($key) &&
                    $old_attributes[$key]===$this->$key) && 
                $this->hasAttribute($key) && 
                !is_null($this->$key
                )){
                $check=true; 
                continue;
            }
            $check=false;
        }
        if($check){
            foreach($primary_keys as $key){
                $old_attributes[$key]=$this->$key;
            }
            $this->setOldAttributes($old_attributes);
        }
        return $check;
    }
    protected function reflectForcePrimaryKeys():bool
    {
        $primary_keys=static::primaryKey();
        $old_attributes=$this->getOldAttributes();
        $check=false;
        foreach($primary_keys as $key){
            if($this->hasAttribute($key) &&
                !is_null($this->$key)
            ){
                $check=true;
                continue;
            }
            $check=false;
        }
        if($check){
            foreach($primary_keys as $key){
                $old_attributes[$key]=$this->$key;
            }
            $this->setOldAttributes($old_attributes);
        }
        return $check;
    }
    protected function reflectFields(array $fields=null):self
    {
        if(is_null($fields)){
            $fields=$this->attributes();
        }
        foreach ($fields as $key) {
            if(property_exists($this,$key)){
                $this->__set($key,$this->$key);
            }
        }
        return $this;
    }
    
    protected function backReflectFields(array $fields=null):self
    {
        if(is_null($fields)){
            $fields=$this->attributes();
        }
        foreach ($fields as $key) {
            if(property_exists($this,$key)){
                $this->$key=$this->__get($key);
            } 
        }
        return $this;
    }
}