<?php

use yii\db\Migration;

class m170212_071556_periods extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%periods}}', [
            'id' => $this->primaryKey(),
            'date_start' => $this->date()->notNull(),
            'date_end' => $this->date()->notNull()
        ],$tableOptions);

        $this->createTable('{{%periods_via}}', [
            'room_id' => $this->integer()->notNull(),
            'period_id' => $this->integer()->notNull(),
            'value' => $this->integer()->defaultValue(0)
        ],$tableOptions);

        $this->addPrimaryKey('pk-periods_via', '{{%periods_via}}', ['room_id', 'period_id']);

        $this->createIndex('idx-periods_via-room_id', '{{%periods_via}}', 'room_id');
        $this->createIndex('idx-periods_via-period_id', '{{%periods_via}}', 'period_id');

        $this->addForeignKey('fk-periods_via-room', '{{%periods_via}}', 'room_id', '{{%rooms}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-periods_via-period', '{{%periods_via}}', 'period_id', '{{%periods}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropTable('{{%periods}}');
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
