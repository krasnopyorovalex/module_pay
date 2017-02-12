<?php

use yii\db\Migration;

class m170211_082240_payment_methods extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%payment_methods}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'description' => $this->text()
        ],$tableOptions);

        $this->createTable('{{%payment_methods_via}}', [
            'room_id' => $this->integer()->notNull(),
            'payment_method_id' => $this->integer()->notNull()
        ],$tableOptions);

        $this->addPrimaryKey('pk-payment_methods_via', '{{%payment_methods_via}}', ['room_id', 'payment_method_id']);

        $this->createIndex('idx-payment_methods_via-room_id', '{{%payment_methods_via}}', 'room_id');
        $this->createIndex('idx-payment_methods_via-payment_method_id', '{{%payment_methods_via}}', 'payment_method_id');

        $this->addForeignKey('fk-payment_methods_via-room', '{{%payment_methods_via}}', 'room_id', '{{%rooms}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-payment_methods_via-attribute', '{{%payment_methods_via}}', 'payment_method_id', '{{%payment_methods}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%payment_methods}}');
        $this->dropTable('{{%payment_methods_via}}');
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
