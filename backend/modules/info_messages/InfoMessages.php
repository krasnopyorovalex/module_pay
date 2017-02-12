<?php

namespace backend\modules\info_messages;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * info_messages module definition class
 */
class InfoMessages extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\info_messages\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Информационные сообщения';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\InfoMessages::className();
    }
}
