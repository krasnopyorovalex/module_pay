<?php

use yii\db\Migration;

class m170212_063730_info_messages extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%info_messages}}', [
            'id' => $this->primaryKey(),
            'icon' => $this->string(64)->notNull(),
            'name' => $this->string(128)->notNull(),
            'description' => $this->text(),
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%info_messages}}');

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
