<?php

namespace App\Alpa\Food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_menu}}`.
 */
class M220727144343CreateFoodMenuTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_menu}}', [
            'id' => $this->primaryKey()->unsigned(),
            'provider_id'=>$this->integer()->unsigned()->notNull(),
            'name'=>$this->char(255),
            'compound'=>$this->text(),
            'price'=>$this->decimal(12,2)->unsigned(),
            'created_at'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at'=>$this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'deleted_at'=>$this->timestamp()->null()->defaultValue(null)
        ]);
        $this->addForeignKey('fk-food_menu-provider_id','{{%food_menu}}','provider_id','{{%food_providers}}','id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-food_menu-provider_id',
            '{{%food_menu}}'
        );
        $this->dropTable('{{%food_menu}}');
    }
}
