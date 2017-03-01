<?php

namespace backend\modules\accommodation_options\controllers;

use backend\controllers\ModuleController;
use common\models\AccommodationOptions as Model;

/**
 * Default controller for the `accommodation_options` module
 */
class DefaultController extends ModuleController
{
    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => $this->findData(Model::find()->orderBy('pos'))
        ]);
    }
}
