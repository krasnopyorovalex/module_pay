<?php

namespace backend\modules\settings;

/**
 * settings module definition class
 */
class Settings extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\settings\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Настройки сайта';
        // custom initialization code goes here
    }
}
