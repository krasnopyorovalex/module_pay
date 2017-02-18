<?php

use yii\db\Migration;

class m170210_113626_rooms_images extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%rooms_images}}', [
            'id' => $this->primaryKey(),
            'room_id' => $this->integer()->notNull(),
            'name' => $this->string(512)->notNull(),
            'alt' => $this->string(512)->notNull(),
            'title' => $this->string(512)->notNull(),
            'basename' => $this->string(256)->notNull(),
            'ext' => $this->string(5)->notNull(),
            'publish' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'pos' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('idx-gallery_images-room_id', '{{%rooms_images}}', 'room_id');
        $this->addForeignKey('fk-rooms_images-room_id', '{{%rooms_images}}','room_id','{{%rooms}}','id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%rooms}}');
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
