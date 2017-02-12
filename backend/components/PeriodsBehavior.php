<?php
namespace backend\components;

use common\models\PeriodsVia;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class PeriodsBehavior
 * @package backend\components
 */
class PeriodsBehavior extends Behavior
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
        if($this->owner->periodsArray){
            $this->owner->unlinkAll('periods', true);
            foreach ($this->owner->periodsArray as $key => $value){
                (new PeriodsVia([
                    'room_id' => $this->owner->id,
                    'period_id' => $key,
                    'value' => $value
                ]))->save();
            }
        }
    }

}