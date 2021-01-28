<?php

use yii\db\Migration;

/**
 * Class m210128_175114_add_column_period_id_to_accommodation_options_via_table
 */
class m210128_175114_add_column_period_id_to_accommodation_options_via_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->dropTable('{{%accommodation_options_via}}');

        $this->createTable('{{%accommodation_options_via}}', [
            'room_id' => $this->integer()->notNull(),
            'accommodation_option_id' => $this->integer()->notNull(),
            'period_id' => $this->integer()->notNull(),
            'value' => $this->integer()->defaultValue(0),
        ],$tableOptions);

        $this->addPrimaryKey('pk-accommodation_options_via', '{{%accommodation_options_via}}', ['room_id', 'accommodation_option_id', 'period_id']);

        $this->createIndex('idx-accommodation_options_via-room_id', '{{%accommodation_options_via}}', 'room_id');
        $this->createIndex('idx-accommodation_options_via-accommodation_option_id', '{{%accommodation_options_via}}', 'accommodation_option_id');
        $this->createIndex('idx-accommodation_options_via-period_id', '{{%accommodation_options_via}}', 'period_id');

        $this->addForeignKey('fk-accommodation_options_via-room', '{{%accommodation_options_via}}', 'room_id', '{{%rooms}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-accommodation_options_via-accommodation_option', '{{%accommodation_options_via}}', 'accommodation_option_id', '{{%accommodation_options}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-accommodation_options_via-period_id', '{{%accommodation_options_via}}', 'period_id', '{{%periods}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->dropTable('{{%accommodation_options_via}}');

        $this->createTable('{{%accommodation_options_via}}', [
            'room_id' => $this->integer()->notNull(),
            'accommodation_option_id' => $this->integer()->notNull(),
            'value' => $this->integer()->defaultValue(0),
        ],$tableOptions);

        $this->addPrimaryKey('pk-accommodation_options_via', '{{%accommodation_options_via}}', ['room_id', 'accommodation_option_id']);

        $this->createIndex('idx-accommodation_options_via-room_id', '{{%accommodation_options_via}}', 'room_id');
        $this->createIndex('idx-accommodation_options_via-accommodation_option_id', '{{%accommodation_options_via}}', 'accommodation_option_id');

        $this->addForeignKey('fk-accommodation_options_via-room', '{{%accommodation_options_via}}', 'room_id', '{{%rooms}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-accommodation_options_via-accommodation_option', '{{%accommodation_options_via}}', 'accommodation_option_id', '{{%accommodation_options}}', 'id', 'CASCADE', 'RESTRICT');

        return false;
    }
}
