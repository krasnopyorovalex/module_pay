<?php

namespace backend\modules\discounts;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * discounts module definition class
 */
class Discounts extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\discounts\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Скидки';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Discounts::className();
    }
}
