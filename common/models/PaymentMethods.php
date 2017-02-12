<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%payment_methods}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property PaymentMethodsVia[] $paymentMethodsVias
 * @property Rooms[] $rooms
 */
class PaymentMethods extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment_methods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
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
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodsVias()
    {
        return $this->hasMany(PaymentMethodsVia::className(), ['payment_method_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['id' => 'room_id'])->viaTable('{{%payment_methods_via}}', ['payment_method_id' => 'id']);
    }
}
