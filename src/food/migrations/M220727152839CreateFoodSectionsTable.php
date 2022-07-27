<?php

namespace App\Alpa\Food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_sections}}`.
 */
class M220727152839CreateFoodSectionsTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_sections}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name'=>$this->char(100),
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
        $this->dropTable('{{%food_sections}}');
    }
}
