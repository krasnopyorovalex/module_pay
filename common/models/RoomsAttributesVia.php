<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "rooms_attributes_via".
 *
 * @property integer $room_id
 * @property integer $attribute_id
 * @property string $value
 *
 * @property RoomsAttributes $attribute
 * @property Rooms $room
 */
class RoomsAttributesVia extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rooms_attributes_via}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'attribute_id', 'value'], 'required'],
            [['room_id', 'attribute_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => RoomsAttributes::className(), 'targetAttribute' => ['attribute_id' => 'id']],
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
            'attribute_id' => 'Attribute ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomAttribute()
    {
        return $this->hasOne(RoomsAttributes::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }
}
