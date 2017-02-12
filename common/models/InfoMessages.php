<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%info_messages}}".
 *
 * @property integer $id
 * @property string $icon
 * @property string $name
 * @property string $description
 */
class InfoMessages extends ActiveRecord
{

    public $icons = [
        'icon-user' => 'Пользователь',
        'icon-time' => 'Время',
        'icon-pay' => 'Оплата'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%info_messages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icon', 'name'], 'required'],
            [['description'], 'string'],
            [['icon'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icon' => 'Иконка',
            'name' => 'Название',
            'description' => 'Описание',
        ];
    }
}
