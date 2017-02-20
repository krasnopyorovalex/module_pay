<?php

use yii\db\Migration;

class m170220_073038_settings extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'sys_name' => $this->string(128)->notNull(),
            'value' => $this->text(),
        ],$tableOptions);


        $this->insert('{{%settings}}',['sys_name' => 'phone','value' => '']);
        $this->insert('{{%settings}}',['sys_name' => 'email','value' => '']);
        $this->insert('{{%settings}}',['sys_name' => 'success_message','value' => '']);
        $this->insert('{{%settings}}',['sys_name' => 'empty_message','value' => '']);
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');

        return false;
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
