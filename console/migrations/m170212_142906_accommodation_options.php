<?php

use yii\db\Migration;

class m170212_142906_accommodation_options extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%accommodation_options}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'max_count' => $this->integer()->defaultValue(0)
        ],$tableOptions);

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
    }

    public function down()
    {
        $this->dropTable('{{%accommodation_options}}');
        $this->dropTable('{{%accommodation_options_via}}');
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
