<?php

namespace backend\modules\tariffs;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * tariffs module definition class
 */
class Tariffs extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\tariffs\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Тарифы';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Tariffs::className();
    }
}
