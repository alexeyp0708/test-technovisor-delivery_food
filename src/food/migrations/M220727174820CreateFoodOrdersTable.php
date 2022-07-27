<?php

namespace App\Alpa\Food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_orders}}`.
 */
class M220727174820CreateFoodOrdersTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_orders}}', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id'=>$this->integer()->unsigned(),
            'user_name'=>$this->char(255),
            'created_at'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at'=>$this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'deleted_at'=>$this->timestamp()->null()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%food_orders}}');
    }
}
