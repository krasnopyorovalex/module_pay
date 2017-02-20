<?php

namespace backend\modules\settings\controllers;
use backend\controllers\SiteController;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use common\models\Settings;
use Yii;

/**
 * Default controller for the `settings` module
 */
class DefaultController extends SiteController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $settings = Settings::find()->asArray()->all();
        return $this->render('index',[
            'settings' => ArrayHelper::index($settings, 'sys_name')
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Settings::findOne($id);
        if(Yii::$app->request->isPost) {
            $model->value = Yii::$app->request->post('value');
            $model->save();
        }
        return $this->redirect(Yii::$app->homeUrl . $this->module->id);
    }

}