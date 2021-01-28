<?php
/* @var $this yii\web\View */
/* @var $model common\models\Rooms */
/* @var array $tariffs */
/* @var array $method_payments_array */
/* @var array $attributes_array */
/* @var array $periods_array */
/* @var array $discounts_array */
/* @var array $ao_array */
/* @var array $ao_room */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;
use backend\assets\GalleryAsset;

CkEditorAsset::register($this);
GalleryAsset::register($this);

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

                        <div class="row padded">

                            <div class="box-header">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="icon-home"></i></a></li>
                                    <li><a href="#gallery" data-toggle="tab"><i class="icon-picture"></i> <span>Галерея</span></a></li>
                                </ul>
                            </div>
                            <div class="box-content padded">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home">
                                        <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up']]); ?>
                                        <div class="col-md-9">
                                            <?= $form->field($model, 'name')->textInput(['autocomplete' => 'off']) ?>
                                            <?= $form->field($model, 'tariff_id')->dropDownList($tariffs, [
                                                'class' => 'chzn-select'
                                            ]) ?>
                                        </div>

                                        <div class="col-md-3">
                                            <?= $form->field($model, 'max_peoples')?>
                                            <?= $form->field($model, 'max_peoples_adults')?>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="values__box">
                                            <div class="box-header">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#periods" data-toggle="tab"><i class="icon-calendar"></i> <span>Периоды\Цены</span></a></li>
                                                    <li><a href="#method_payments" data-toggle="tab"><i class="icon-money"></i> <span>Методы оплаты</span></a></li>
                                                    <li><a href="#attributes" data-toggle="tab"><i class="icon-font"></i> <span>Атрибуты</span></a></li>
                                                    <li><a href="#discounts" data-toggle="tab"><i class="icon-gift"></i> <span>Скидки</span></a></li>
                                                    <li><a href="#ao" data-toggle="tab"><i class="icon-gift"></i> <span>Цены за варианты размещения</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="box-content padded">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="periods">
                                                        <!-- periods for room -->
                                                        <?php if($periods_array):?>
                                                            <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                                            <?php foreach ($periods_array as $period):?>
                                                                <?php $label = 'с '.Yii::$app->formatter->asDate($period['date_start']) .' по '. Yii::$app->formatter->asDate($period['date_end']);?>
                                                                <?= $form->field($model, 'periodsArray['.$period['id'].']')->textInput([
                                                                    'value' => isset($dates_room[$period['id']])
                                                                        ? $dates_room[$period['id']]
                                                                        : ''
                                                                ])->label($label)?>
                                                            <?php endforeach;?>
                                                            <?= Html::endTag('div')?>
                                                        <?php endif;?>
                                                        <!-- periods -->
                                                    </div>
                                                    <div class="tab-pane" id="method_payments">
                                                        <!-- method payments for room -->
                                                        <?php if($method_payments_array):?>
                                                            <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                                            <?= $form->field($model, 'paymentMethodsArray')->dropDownList($method_payments_array,[
                                                                'multiple' => 'multiple',
                                                                'class' => 'chzn-select'
                                                            ])->label(false) ?>
                                                            <?= Html::endTag('div')?>
                                                        <?php endif;?>
                                                        <!-- method payments -->
                                                    </div>
                                                    <div class="tab-pane" id="attributes">
                                                        <!-- attributes room -->
                                                        <?php if($attributes_array):?>
                                                            <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                                            <?php foreach ($attributes_array as $aa):?>
                                                                <?= $form->field($model, 'attrArray['.$aa['id'].']')->textarea([
                                                                    'value' => isset($attributes_room[$aa['id']])
                                                                        ? $attributes_room[$aa['id']]
                                                                        : ''
                                                                ])->label($aa['name'])?>
                                                            <?php endforeach;?>
                                                            <?= Html::endTag('div')?>
                                                        <?php endif;?>
                                                        <!-- attributes rooms -->
                                                    </div>
                                                    <div class="tab-pane" id="discounts">
                                                        <!-- discounts room -->
                                                        <?php if($discounts_array):?>
                                                            <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                                            <?= $form->field($model, 'discountsArray')->dropDownList($discounts_array,[
                                                                'multiple' => 'multiple',
                                                                'class' => 'chzn-select'
                                                            ])->label(false) ?>
                                                            <?= Html::endTag('div')?>
                                                        <?php endif;?>
                                                        <!-- discounts room -->
                                                    </div>
                                                    <div class="tab-pane" id="ao">

                                                        <!-- periods for room -->
                                                        <?php if($periods_array):?>
                                                            <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                                            <?php foreach ($periods_array as $period):?>
                                                                <?= Html::tag('div','с '.Yii::$app->formatter->asDate($period['date_start']) .' по '. Yii::$app->formatter->asDate($period['date_end']),['class' => 'ao__label']);?>

                                                                <!-- accommodation options room -->
                                                                <?php if($ao_array):?>
                                                                    <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                                                    <?php foreach ($ao_array as $ao):?>
                                                                        <?= $form->field($model, 'aoArray['.$ao['id'].'__'.$period['id'].']')->textInput([
                                                                            'value' => (isset($ao_room[$ao['id'].'__'.$period['id']]))
                                                                                ? $ao_room[$ao['id'].'__'.$period['id']]
                                                                                : '',
                                                                            'autocomplete' => 'off'
                                                                        ])->label($ao['name'])?>
                                                                    <?php endforeach;?>
                                                                    <?= Html::endTag('div')?>
                                                                <?php endif;?>
                                                                <!-- accommodation options -->

                                                            <?php endforeach;?>
                                                            <?= Html::endTag('div')?>
                                                        <?php endif;?>
                                                        <!-- periods -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.values__box -->

                                        <?= $this->render('@backend/views/blocks/_actions')?>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                    <div class="tab-pane" id="gallery">
                                        <?php if(!$model->isNewRecord):?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php $formImage = ActiveForm::begin(['action' => Url::toRoute(['/site/multiupload-rooms']), 'id' => 'upload', 'options' => [
                                                        'enctype' => 'multipart/form-data',
                                                        'class' => 'dropzone dz-clickable'
                                                    ]]); ?>
                                                    <span class="triangle-button orange"><i class="icon-plus"></i></span>
                                                    <div class="form-group">
                                                        <div class="dz-message">
                                                            Загрузка изображений<br>
                                                            <span class="icon-cloud-upload icon-2x"></span>
                                                            <?= $formImage->field($images, 'file')->fileInput(['multiple' => true, 'class' => 'hidden'])->label(false) ?>
                                                            <?= Html::input('hidden', 'room_id', $model->id, ['id' => 'room_id']) ?>
                                                        </div>
                                                    </div>
                                                    <?php ActiveForm::end(); ?>
                                                </div>
                                            </div>
                                            <div class="row padded">
                                                <div class="box">
                                                    <div id="image_box">
                                                        <?= $this->render('_image_box', ['model' => $model])?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
<?= Html::tag('div','',['class' => 'modal fade', 'id' => 'edit-image'])?>