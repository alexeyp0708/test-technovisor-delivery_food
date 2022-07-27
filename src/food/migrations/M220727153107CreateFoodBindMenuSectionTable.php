<?php

namespace App\Alpa\Food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_bind_menu_section}}`.
 */
class M220727153107CreateFoodBindMenuSectionTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_bind_menu_section}}', [
            'section_id' => $this->integer()->unsigned()->notNull(),
            'menu_id'=>$this->integer()->unsigned()->notNull(),
            'created_at'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at'=>$this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'deleted_at'=>$this->timestamp()->null()->defaultValue(null),
            'PRIMARY KEY(section_id, menu_id)',
        ]);
        $this->addForeignKey("fk-food_bind_menu_section-section_id", "{{%food_bind_menu_section}}", "section_id", "{{%food_sections}}", "id", "CASCADE", "CASCADE");
        $this->addForeignKey("fk-food_bind_menu_section-menu_id", "{{%food_bind_menu_section}}", "menu_id", "{{%food_menu}}", "id", "CASCADE", "CASCADE");
        //$this->addPrimaryKey('food_bind_menu_section_pk', '{{%food_bind_menu_section}}', ['section_id', 'menu_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-food_bind_menu_section-section_id',
            '{{%food_bind_menu_section}}'
        );
        $this->dropForeignKey(
            'fk-food_bind_menu_section-menu_id',
            '{{%food_bind_menu_section}}'
        );
        $this->dropTable('{{%food_bind_menu_section}}');
    }
}
