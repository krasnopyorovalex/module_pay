<?php

use yii\db\Migration;

class m170212_112336_discounts extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%discounts}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'date_start' => $this->date()->notNull(),
            'date_end' => $this->date()->notNull(),
            'value' => $this->integer()->defaultValue(0),
            'is_early_booking' => $this->smallInteger(1)->defaultValue(0)
        ],$tableOptions);

        $this->createTable('{{%discounts_via}}', [
            'room_id' => $this->integer()->notNull(),
            'discount_id' => $this->integer()->notNull()
        ],$tableOptions);

        $this->addPrimaryKey('pk-discounts_via', '{{%discounts_via}}', ['room_id', 'discount_id']);

        $this->createIndex('idx-discounts_via-room_id', '{{%discounts_via}}', 'room_id');
        $this->createIndex('idx-discounts_via-discount_id', '{{%discounts_via}}', 'discount_id');

        $this->addForeignKey('fk-discounts_via-room', '{{%discounts_via}}', 'room_id', '{{%rooms}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-discounts_via-discount', '{{%discounts_via}}', 'discount_id', '{{%discounts}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%discounts}}');
        $this->dropTable('{{%discounts_via}}');

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
