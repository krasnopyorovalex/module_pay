<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%accommodation_options_via}}".
 *
 * @property integer $room_id
 * @property integer $accommodation_option_id
 * @property integer $value
 *
 * @property AccommodationOptions $accommodationOption
 * @property Rooms $room
 */
class AccommodationOptionsVia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%accommodation_options_via}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'accommodation_option_id'], 'required'],
            [['room_id', 'accommodation_option_id', 'value'], 'integer'],
            [['accommodation_option_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccommodationOptions::className(), 'targetAttribute' => ['accommodation_option_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'Room ID',
            'accommodation_option_id' => 'Accommodation Option ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccommodationOption()
    {
        return $this->hasOne(AccommodationOptions::className(), ['id' => 'accommodation_option_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }
}
