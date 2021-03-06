<?php
/* @var $this yii\web\View */
/* @var $model common\models\Periods */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;

CkEditorAsset::register($this);

$this->params['breadcrumbs'][] = ['label' => $this->context->module->params['name'], 'url' => Url::toRoute(['/'.$this->context->module->id])];
$this->params['breadcrumbs'][] = $this->context->actions[$this->context->action->id];
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        <span class="title"><?= $this->context->actions[$this->context->action->id]?></span>
                    </div>

                    <div class="box-content">

                        <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up']]); ?>

                        <div class="row padded">

                            <div class="col-md-2">
                                <?= $form->field($model, 'date_start')->textInput(['class' => 'datepicker']) ?>
                                <?= $form->field($model, 'date_end')->textInput(['class' => 'datepicker']) ?>
                            </div>
                            <div class="col-md-10"></div>
                        </div>
                        <?= $this->render('@backend/views/blocks/_actions')?>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>

    </div>