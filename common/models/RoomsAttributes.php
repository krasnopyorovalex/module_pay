<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "rooms_attributes".
 *
 * @property integer $id
 * @property string $name
 *
 * @property RoomsAttributesVia[] $roomsAttributesVias
 * @property Rooms[] $rooms
 */
class RoomsAttributes extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rooms_attributes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsAttributesVias()
    {
        return $this->hasMany(RoomsAttributesVia::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['id' => 'room_id'])->viaTable('{{%rooms_attributes_via}}', ['attribute_id' => 'id']);
    }
}
