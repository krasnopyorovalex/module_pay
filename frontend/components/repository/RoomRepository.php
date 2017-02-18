<?php

namespace frontend\components\repository;

use common\models\Rooms;

class RoomRepository implements RepositoryInterface
{

    /**
     * @var array|\yii\db\ActiveRecord[]
     */
    private $data = [];

    public function __construct()
    {
        $this->data = Rooms::find()->with([
            'periods',
            'periodsVias',
            'roomsAttributes',
            'roomsAttributesVias',
            'tariff',
            'roomsImages',
            'paymentMethods',
            'accommodationOptions',
            'discounts'
        ])->asArray()->all();
    }

    public function getAll()
    {
        return $this->data;
    }
}