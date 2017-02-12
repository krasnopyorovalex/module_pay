<?php

namespace backend\modules\rooms;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * rooms module definition class
 */
class Rooms extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\rooms\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Номера';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Rooms::className();
    }
}
