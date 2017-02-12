<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Форма входа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="col-md-4 col-md-offset-3">
        <div class="padded">
            <div class="login box">

                <div class="box-header">
                    <span class="title">Форма входа</span>
                </div>

                <div class="box-content padded">

                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'separate-sections']); ?>
                    <div class="input-group addon-left">
                            <span class="input-group-addon">
                              <i class="icon-user"></i>
                            </span>
                        <?= $form->field($model, 'username')->textInput(['placeholder' => 'имя пользователя'])->label(false) ?>
                    </div>

                    <div class="input-group addon-left">
                            <span class="input-group-addon">
                              <i class="icon-key"></i>
                            </span>
                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'имя пользователя'])->label(false) ?>
                    </div>
                    <div>
                            <span class="btn btn-blue btn-block">
                                <?= Html::submitButton(Html::tag('i',' Войти',['class' => 'icon-signin'])) ?>
                            </span>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>
</div>