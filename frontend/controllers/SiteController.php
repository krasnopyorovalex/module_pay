<?php

namespace frontend\controllers;

use common\models\AccommodationOptions;
use common\models\InfoMessages;
use common\models\PaymentMethods;
use common\models\Rooms;
use common\models\Settings;
use common\models\Tariffs;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public $settings = [];
    /**
     * @return string
     */
    public function actionIndex()
    {
        $dateStartWork = (new \DateTime($this->settings['date_start']))->format('d.m.Y');
        $today = (new \DateTime())->format('d.m.Y');
        $dateStart = ( (strtotime($dateStartWork) < strtotime($today)) ? $today : $dateStartWork );

        return $this->render('index', [
            'info_messages' => InfoMessages::find()->all(),
            'accommodation_options' => AccommodationOptions::find()->orderBy('pos')->all(),
            'max_count_adults' => Rooms::find()->select('max_peoples_adults')->max('max_peoples_adults'),
            'tariffs' => Tariffs::find()->all(),
            'payment_methods' => PaymentMethods::find()->all(),
            'dateStart' => $dateStart,
            'dateEnd' => date('d.m.Y',strtotime($dateStart . "+1 days"))
        ]);
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $this->settings = ArrayHelper::map(Settings::find()->asArray()->all(), 'sys_name', 'value');
        return true;
    }

}
