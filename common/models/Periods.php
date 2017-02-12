<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%periods}}".
 *
 * @property integer $id
 * @property string $date_start
 * @property string $date_end
 *
 * @property PeriodsVia[] $periodsVias
 * @property Rooms[] $rooms
 */
class Periods extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%periods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start', 'date_end'], 'required'],
            [['date_start', 'date_end'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodsVias()
    {
        return $this->hasMany(PeriodsVia::className(), ['period_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['id' => 'room_id'])->viaTable('{{%periods_via}}', ['period_id' => 'id']);
    }
}
