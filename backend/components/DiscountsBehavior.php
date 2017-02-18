<?php
namespace backend\components;

use common\models\DiscountsVia;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class DiscountsBehavior
 * @package backend\components
 */
class DiscountsBehavior extends Behavior
{
    /**
     * @param \yii\base\Component $owner
     */
    public function attach($owner)
    {
        parent::attach($owner);
        $owner->on(ActiveRecord::EVENT_BEFORE_UPDATE, [$this, 'onBeforeSave']);
        $owner->on(ActiveRecord::EVENT_AFTER_INSERT, [$this, 'onBeforeSave']);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function onBeforeSave()
    {
        if($this->owner->discountsArray){
            $this->owner->unlinkAll('discounts', true);
            foreach ($this->owner->discountsArray as $discount){
                (new DiscountsVia([
                    'room_id' => $this->owner->id,
                    'discount_id' => $discount
                ]))->save();
            }
        }
    }

}