<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%rooms}}`.
 */
class m210204_083734_add_pos_column_to_rooms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%rooms}}', 'pos', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%rooms}}', 'pos');
    }
}
