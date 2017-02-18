<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%discounts}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date_start
 * @property string $date_end
 * @property integer $value
 * @property integer $is_early_booking
 *
 * @property DiscountsVia[] $discountsVias
 * @property Rooms[] $rooms
 */
class Discounts extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%discounts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_start', 'date_end'], 'required'],
            [['description'], 'string'],
            [['date_start', 'date_end'], 'safe'],
            [['value', 'is_early_booking'], 'integer'],
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
            'description' => 'Описание',
            'date_start' => 'Дата старта',
            'date_end' => 'Дата окончания',
            'value' => 'Процент скидки',
            'is_early_booking' => 'Раннее бронирование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountsVias()
    {
        return $this->hasMany(DiscountsVia::className(), ['discount_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['id' => 'room_id'])->viaTable('{{%discounts_via}}', ['discount_id' => 'id']);
    }
}
