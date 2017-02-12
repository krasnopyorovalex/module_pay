<?php

use yii\db\Migration;

class m170209_123022_rooms extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%rooms}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'max_peoples' => $this->integer()->notNull(),
            'max_peoples_adults' => $this->integer()->notNull(),
            'tariff_id' => $this->integer(),
        ],$tableOptions);

        $this->addForeignKey('fk-rooms_tariff_id', '{{%rooms}}', 'tariff_id', '{{%tariffs}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%rooms}}');
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
