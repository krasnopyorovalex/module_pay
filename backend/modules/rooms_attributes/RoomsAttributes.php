<?php

namespace backend\modules\rooms_attributes;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;
use common\models\RoomsAttributes as RA;

/**
 * rooms_attributes module definition class
 */
class RoomsAttributes extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\rooms_attributes\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Атрибуты';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return RA::className();
    }
}
