<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%accommodation_options}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $max_count
 *
 * @property AccommodationOptionsVia[] $accommodationOptionsVias
 * @property Rooms[] $rooms
 */
class AccommodationOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%accommodation_options}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['max_count'], 'integer'],
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
            'max_count' => 'Максимальное количество',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccommodationOptionsVias()
    {
        return $this->hasMany(AccommodationOptionsVia::className(), ['accommodation_option_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['id' => 'room_id'])->viaTable('{{%accommodation_options_via}}', ['accommodation_option_id' => 'id']);
    }
}
