<?php

namespace App\Alpa\Food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_bind_order_menu}}`.
 */
class M220727200730CreateFoodBindOrderMenuTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_bind_order_menu}}', [
            'order_id' => $this->integer()->unsigned()->notNull(),
            'menu_id' => $this->integer()->unsigned()->notNull(),
            'food_name' => $this->char(255),
            'food_compaund' => $this->text(),
            'food_price'=>$this->decimal(12,2)->unsigned(),
            'food_count'=>$this->tinyInteger()->unsigned(),
            'PRIMARY KEY(order_id, menu_id)',
        ]);
        $this->addForeignKey('fk-food_bind_order_menu-order_id', '{{%food_bind_order_menu}}', "order_id", '{{%food_orders}}', "id", "CASCADE", "CASCADE");
        $this->addForeignKey('fk-food_bind_order_menu-menu_id', '{{%food_bind_order_menu}}', "menu_id", '{{%food_menu}}', "id", "CASCADE", "CASCADE");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-{{%food_order_menu}}-order_id',
            '{{%food_order_menu}}'
        );
        $this->dropForeignKey(
            'fk-{{%food_order_menu}}-menu_id',
            '{{%food_order_menu}}'
        );
        $this->dropTable('{{%food_order_menu}}');
    }
}
