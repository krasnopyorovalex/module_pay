<?php

namespace frontend\controllers;

use frontend\components\repository\RepositoryInterface;
use frontend\models\SendModel;
use yii\helpers\Html;

/**
 * Order Controller
 */
class OrderController extends SiteController
{
    /**
     * @var RepositoryInterface
     */
    protected $roomRepository;

    public function __construct($id, $module, RepositoryInterface $roomRepository, $config = [])
    {
        $this->roomRepository = $roomRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $roomId = \Yii::$app->request->post('roomId');
        $model = $this->roomRepository->getById($roomId);
        $data = [
            'params' => \Yii::$app->request->post('params'),
            'name' => \Yii::$app->request->post('name'),
            'email' => \Yii::$app->request->post('email'),
            'phone' => \Yii::$app->request->post('phone'),
            'message' => \Yii::$app->request->post('message'),
            'price' => \Yii::$app->request->post('price'),
            'diffDays' => \Yii::$app->request->post('diffDays'),
            'room' => $model
        ];
        $order = new SendModel($data,  \Yii::$app->request->post('params'));
        if($order->send($this->settings['email']))
        {
            return Html::tag('div', $this->settings['success_message'], ['class' => 'success_message']);
        }
        return false;
    }

}
