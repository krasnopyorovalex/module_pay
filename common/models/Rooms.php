<?php

namespace common\models;

use backend\components\AccommodationOptionsBehavior;
use backend\components\AttributesBehavior;
use backend\components\DiscountsBehavior;
use backend\components\PaymentMethodsBehavior;
use backend\components\PeriodsBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%rooms}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $max_peoples
 * @property integer $max_peoples_adults
 * @property integer $tariff_id
 *
 * @property AccommodationOptionsVia[] $accommodationOptionsVias
 * @property AccommodationOptions[] $accommodationOptions
 * @property DiscountsVia[] $discountsVias
 * @property Discounts[] $discounts
 * @property PaymentMethodsVia[] $paymentMethodsVias
 * @property PaymentMethods[] $paymentMethods
 * @property PeriodsVia[] $periodsVias
 * @property Periods[] $periods
 * @property Tariffs $tariff
 * @property RoomsAttributesVia[] $roomsAttributesVias
 * @property RoomsAttributes[] $attributes
 * @property RoomsImages[] $roomsImages
 */
class Rooms extends ActiveRecord
{

    public $attrArray = [];
    public $paymentMethodsArray = [];
    public $periodsArray = [];
    public $discountsArray = [];
    public $aoArray = [];

    public function behaviors()
    {
        return [
            [
                'class' => AttributesBehavior::className()
            ],
            [
                'class' => PaymentMethodsBehavior::className()
            ],
            [
                'class' => PeriodsBehavior::className()
            ],
            [
                'class' => DiscountsBehavior::className()
            ],
            [
                'class' => AccommodationOptionsBehavior::className()
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rooms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'max_peoples', 'max_peoples_adults'], 'required'],
            [['max_peoples', 'max_peoples_adults', 'tariff_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['tariff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tariffs::className(), 'targetAttribute' => ['tariff_id' => 'id']],
            [['attrArray', 'paymentMethodsArray', 'periodsArray', 'discountsArray', 'aoArray'], 'safe'],
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
            'max_peoples' => 'Максимальное количество',
            'max_peoples_adults' => 'Максимальное количество взрослых',
            'tariff_id' => 'Тариф номера'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccommodationOptionsVias()
    {
        return $this->hasMany(AccommodationOptionsVia::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccommodationOptions()
    {
        return $this->hasMany(AccommodationOptions::className(), ['id' => 'accommodation_option_id'])->viaTable('{{%accommodation_options_via}}', ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodsVias()
    {
        return $this->hasMany(PaymentMethodsVia::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethods()
    {
        return $this->hasMany(PaymentMethods::className(), ['id' => 'payment_method_id'])->viaTable('{{%payment_methods_via}}', ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTariff()
    {
        return $this->hasOne(Tariffs::className(), ['id' => 'tariff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsImages()
    {
        return $this->hasMany(RoomsImages::className(), ['room_id' => 'id'])->orderBy('pos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsAttributesVias()
    {
        return $this->hasMany(RoomsAttributesVia::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsAttributes()
    {
        return $this->hasMany(RoomsAttributes::className(), ['id' => 'attribute_id'])->viaTable('{{%rooms_attributes_via}}', ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodsVias()
    {
        return $this->hasMany(PeriodsVia::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriods()
    {
        return $this->hasMany(Periods::className(), ['id' => 'period_id'])->viaTable('{{%periods_via}}', ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountsVias()
    {
        return $this->hasMany(DiscountsVia::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscounts()
    {
        return $this->hasMany(Discounts::className(), ['id' => 'discount_id'])->viaTable('{{%discounts_via}}', ['room_id' => 'id']);
    }

    public function afterFind()
    {
        $this->paymentMethodsArray = ArrayHelper::getColumn($this->paymentMethods, 'id');
        $this->discountsArray = ArrayHelper::getColumn($this->discounts, 'id');
    }

}
