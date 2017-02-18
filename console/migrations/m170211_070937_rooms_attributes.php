<?php

use yii\db\Migration;

class m170211_070937_rooms_attributes extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%rooms_attributes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ],$tableOptions);

        $this->createTable('{{%rooms_attributes_via}}', [
            'room_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
            'value' => $this->text()->notNull(),
        ],$tableOptions);

        $this->addPrimaryKey('pk-rooms_attributes_via', '{{%rooms_attributes_via}}', ['room_id', 'attribute_id']);

        $this->createIndex('idx-rooms_attributes_via-room_id', '{{%rooms_attributes_via}}', 'room_id');
        $this->createIndex('idx-rooms_attributes_via-attribute_id', '{{%rooms_attributes_via}}', 'attribute_id');

        $this->addForeignKey('fk-rooms_attributes_via-room', '{{%rooms_attributes_via}}', 'room_id', '{{%rooms}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-rooms_attributes_via-attribute', '{{%rooms_attributes_via}}', 'attribute_id', '{{%rooms_attributes}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%rooms_attributes}}');
        $this->dropTable('{{%rooms_attributes_via}}');
        return true;
    }
}
