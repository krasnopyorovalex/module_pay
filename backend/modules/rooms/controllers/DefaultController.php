<?php

namespace backend\modules\rooms\controllers;

use backend\components\MultiuploadRooms;
use backend\controllers\ModuleController;
use common\models\AccommodationOptions;
use common\models\Discounts;
use common\models\PaymentMethods;
use common\models\Periods;
use common\models\Rooms;
use common\models\RoomsAttributes;
use common\models\RoomsImages;
use common\models\Tariffs;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `rooms` module
 */
class DefaultController extends ModuleController
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['image-edit','update-positions', 'load', 'image-remove', 'update-pos'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'image-edit' => ['post'],
                    'update-positions' => ['post'],
                    'load' => ['post'],
                    'image-remove' => ['post'],
                    'update-pos' => ['post'],
                    'remove-checked' => ['post'],
                    'move-checked' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = $this->model;
        return $this->render('index',[
            'dataProvider' => $this->findData($model::find())
        ]);
    }

    public function actionAdd()
    {
        $model = new Rooms();
        if($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->redirect(\Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', $this->loadDataForRoom($model));
    }

    public function actionUpdate($id)
    {
        if(!$model = Rooms::find()->where(['id' => $id])->with(['roomsAttributesVias','paymentMethods'])->one()){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->redirect(\Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', $this->loadDataForRoom($model));
    }
    public function actionDelete($id)
    {
        $model = Rooms::findOne($id);
        if(\Yii::$app->request->isPost && $model->delete()){
            FileHelper::removeDirectory(\Yii::getAlias('@frontend'.RoomsImages::PATH . $id . MultiuploadRooms::DELIMITER));
            return $this->redirect(\Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', $this->loadDataForRoom($model));
    }

    public function actionImageEdit($id)
    {
        $model = RoomsImages::findOne($id);
        if($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()){
            return Json::encode($this->renderAjax('_image_box', ['model' => Rooms::find()->where(['id' => $model->room_id])->with(['roomsImages'])->one()]));
        }
        return $this->renderAjax('_image_edit', ['model' => $model]);
    }

    public function actionLoad($id)
    {
        return $this->_load($id);
    }

    public function actionImageRemove($id)
    {
        return RoomsImages::findOne($id)->delete();
    }

    public function actionUpdatePositions()
    {
        foreach(\Yii::$app->request->post('values') as $key => $value)
        {
            $image = RoomsImages::findOne(['id' => (int)$value]);
            $image->pos = $key;
            $image->update();
        }
    }

    private function _load($id)
    {
        return $this->renderAjax('_image_box', ['model' => Rooms::find()->where(['id' => $id])->with(['roomsImages'])->one()]);
    }

    /**
     * @param $model
     * @return array
     */
    private function loadDataForRoom($model)
    {
        return [
            'model' => $model,
            'attributes_room' => ArrayHelper::map($model['roomsAttributesVias'], 'attribute_id', 'value'),
            'attributes_array' => RoomsAttributes::find()->asArray()->all(),
            'tariffs' => ArrayHelper::map(Tariffs::find()->asArray()->all(),'id','name'),
            'method_payments_array' => ArrayHelper::map(PaymentMethods::find()->asArray()->all(),'id','name'),
            'periods_array' => Periods::find()->asArray()->all(),
            'dates_room' => ArrayHelper::map($model['periodsVias'], 'period_id', 'value'),
            'discounts_array' => ArrayHelper::map(Discounts::find()->asArray()->all(),'id','name'),
            'ao_room' => ArrayHelper::map($model['accommodationOptionsVias'], 'accommodation_option_id', 'value'),
            'ao_array' => AccommodationOptions::find()->asArray()->all(),
            'images' => new RoomsImages,
        ];
    }
}
