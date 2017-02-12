<?php

namespace backend\controllers;

use Yii;
use backend\interfaces\IActions;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use backend\interfaces\ModelProviderInterface;
use yii\web\NotFoundHttpException;

class ModuleController extends SiteController implements IActions
{
    protected $model = null;

    public $actions = [
        'update' => 'Обновление',
        'add' => 'Добавление',
        'delete' => 'Удаление',
    ];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'add', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function init()
    {
        if ($this->module instanceof ModelProviderInterface) {
            $this->model = $this->module->getModel();
        }
        if(!$this->model){
            throw new \ErrorException('Не реализован метод getModels() у модуля');
        }
    }

    public function actionIndex()
    {
        $model = $this->model;
        return $this->render('index',[
            'dataProvider' => $this->findData($model::find())
        ]);
    }

    public function actionAdd()
    {
        $model = new $this->model;
        $this->loadData($model);
        return $this->render('form',[
            'model' => new $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->model;
        if(!$model = $model::findOne(['id' => $id])){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $this->loadData($model);
        return $this->render('form', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = $this->model;
        if(Yii::$app->request->isPost && $model::findOne($id)->delete()){
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        if(!$model = $model::findOne(['id' => $id])){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('form', ['model' => $model]);
    }

    protected function findData($query)
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => false
        ]);
    }

    protected function loadData($model, $redirect = null)
    {
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            if($redirect){
                return $this->redirect($redirect);
            }
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
    }
}