<?php
namespace backend\components;

use common\models\PaymentMethodsVia;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class PaymentMethodsBehavior
 * @package backend\components
 */
class PaymentMethodsBehavior extends Behavior
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
        if($this->owner->paymentMethodsArray){
            $this->owner->unlinkAll('paymentMethods', true);
            foreach ($this->owner->paymentMethodsArray as $payment_method){
                (new PaymentMethodsVia([
                    'room_id' => $this->owner->id,
                    'payment_method_id' => $payment_method
                ]))->save();
            }
        }
    }

}