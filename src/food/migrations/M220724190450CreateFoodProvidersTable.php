<?php

namespace App\Alpa\Food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_providers}}`.
 */
class M220724190450CreateFoodProvidersTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_providers}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->char(100),
            'is_enabled'=>$this->boolean()->defaultValue(true),
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
        $this->dropTable('{{%food_providers}}');
    }
}
