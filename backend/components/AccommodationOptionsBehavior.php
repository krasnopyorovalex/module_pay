<?php
namespace backend\components;

use common\models\AccommodationOptionsVia;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class AccommodationOptionsBehavior
 * @package backend\components
 */
class AccommodationOptionsBehavior extends Behavior
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
        if($this->owner->attrArray){
            $this->owner->unlinkAll('accommodationOptions', true);
            foreach ($this->owner->aoArray as $key => $value){
                $parts = explode('__',$key);
                (new AccommodationOptionsVia([
                    'room_id' => $this->owner->id,
                    'accommodation_option_id' => $parts[0],
                    'period_id' => $parts[1],
                    'value' => $value
                ]))->save();
            }
        }
    }

}