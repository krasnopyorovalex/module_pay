<?php
/* @var $this yii\web\View */
/* @var $model common\models\PaymentMethods */

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

                        <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>

                        <div class="row padded">

                            <div class="col-md-12">
                                <?= $form->field($model, 'name')->textInput(['id' => 'transliterate__input', 'autocomplete' => 'off']) ?>
                                <?= $form->field($model, 'description')->textarea() ?>
                            </div>
                        </div>
                        <?= $this->render('@backend/views/blocks/_actions')?>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>

    </div>