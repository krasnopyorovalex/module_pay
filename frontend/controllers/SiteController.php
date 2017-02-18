<?php
namespace frontend\controllers;

use common\models\AccommodationOptions;
use common\models\InfoMessages;
use common\models\Rooms;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'info_messages' => InfoMessages::find()->all(),
            'accommodation_options' => AccommodationOptions::find()->all(),
            'max_count_adults' => Rooms::find()->select('max_peoples_adults')->max('max_peoples_adults')
        ]);
    }

    public function actionError()
    {
        return $this->render('error');
    }
}
