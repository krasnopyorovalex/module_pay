<?php
namespace frontend\controllers;

use common\models\AccommodationOptions;
use common\models\InfoMessages;
use common\models\Rooms;
use common\models\Settings;
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

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $this->settings = ArrayHelper::map(Settings::find()->asArray()->all(), 'sys_name', 'value');
        return true;
    }

}
