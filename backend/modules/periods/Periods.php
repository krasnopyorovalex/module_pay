<?php

namespace backend\modules\periods;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * periods module definition class
 */
class Periods extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\periods\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Периоды';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Periods::className();
    }
}
