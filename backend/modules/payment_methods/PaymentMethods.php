<?php

namespace backend\modules\payment_methods;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * payment_methods module definition class
 */
class PaymentMethods extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\payment_methods\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Методы оплаты';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\PaymentMethods::className();
    }
}
