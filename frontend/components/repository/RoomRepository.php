<?php

namespace frontend\components\repository;

use common\models\Rooms;
use yii\helpers\ArrayHelper;

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
            'tariff',
            'periodsVias',
            'discounts',
            'roomsAttributes',
            'roomsAttributesVias',
            'roomsImages',
            'paymentMethods',
            'accommodationOptions',
            'accommodationOptionsVias'
        ])->asArray()->all();
    }

    public function getAll()
    {
        return $this->data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $result = ArrayHelper::index($this->data,'id');
        if(!isset($result[$id]))
        {
            new \Exception('Not Fount By id');
        }
        return $result[$id];
    }
}