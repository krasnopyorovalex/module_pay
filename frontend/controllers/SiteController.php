<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'main.twig';

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index.twig');
    }

    public function actionError()
    {
        return $this->render('error.twig');
    }
}
