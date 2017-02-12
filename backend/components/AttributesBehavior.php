<?php
namespace backend\components;

use common\models\RoomsAttributesVia;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class AttributesBehavior
 * @package backend\components
 */
class AttributesBehavior extends Behavior
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
            $this->owner->unlinkAll('roomsAttributes', true);
            foreach ($this->owner->attrArray as $key => $value){
                (new RoomsAttributesVia([
                    'room_id' => $this->owner->id,
                    'attribute_id' => $key,
                    'value' => $value
                ]))->save();
            }
        }
    }

}