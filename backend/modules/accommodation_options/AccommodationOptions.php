<?php

namespace backend\modules\accommodation_options;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * accommodation_options module definition class
 */
class AccommodationOptions extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\accommodation_options\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Варианты размещения';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\AccommodationOptions::className();
    }
}
