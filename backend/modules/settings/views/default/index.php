<?php
/* @var $this yii\web\View */
/* @var $settings common\models\ */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;

CkEditorAsset::register($this);
$this->params['breadcrumbs'][] = $this->context->module->params['name'];
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title">Настройки сайта</span></div>
                <div class="box-content padded">
                    <div class="box-header">
                        <ul class="nav nav-tabs nav-tabs-left">
                            <li class="active"><a href="#phone" data-toggle="tab"><span>Телефон</span></a></li>
                            <li><a href="#email" data-toggle="tab"><span>Email</span></a></li>
                            <li><a href="#success_message" data-toggle="tab"><span>Сообщение после успешного бронирования</span></a></li>
                            <li><a href="#empty_message" data-toggle="tab"><span>Сообщение при отсутствии номеров</span></a></li>
                            <li><a href="#date_start" data-toggle="tab"><span>Режим работы - старт</span></a></li>
                            <li><a href="#date_end" data-toggle="tab"><span>Режим работы - до</span></a></li>
                            <li><a href="#first_title" data-toggle="tab"><span>Заголовок первого выбора размещения</span></a></li>
                        </ul>
                    </div>

                    <div class="box-content padded">
                        <div class="tab-content">
                            <div class="tab-pane active" id="phone">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['phone']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['phone']['value'], ['class'=>'form-control'])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="first_title">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['first_title']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['first_title']['value'], ['class'=>'form-control'])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="email">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['email']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['email']['value'], ['class'=>'form-control'])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="success_message">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['success_message']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::textarea('value', $settings['success_message']['value'], ['class' => 'form-control', 'rows' => 5]) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="empty_message">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['empty_message']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::textarea('value', $settings['empty_message']['value'], ['class' => 'form-control', 'rows' => 5]) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="date_start">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['date_start']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['date_start']['value'], ['class'=>'datepicker'])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="date_end">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['date_end']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['date_end']['value'], ['class'=>'datepicker'])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                        </div>
                    </div>

                    <div class="box-header">
                        <ul class="nav nav-tabs nav-tabs-left">
                            <li class="active"><a href="#logo" data-toggle="tab"><span>Логотип</span></a></li>
                            <li><a href="#link_home" data-toggle="tab"><span>Ссылка на сайт</span></a></li>
                        </ul>
                    </div>

                    <div class="box-content padded">
                        <div class="tab-content">
                            <div class="tab-pane active" id="logo">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['logo']['id']]), 'post', ['enctype' => 'multipart/form-data', 'class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?php if($settings['logo']['value']):?>
                                        <?= Html::img('/userfiles/' . $settings['logo']['value'])?>
                                        <p></p>
                                    <?php endif;?>
                                    <?= Html::fileInput('file', '', ['class' => 'form-control']) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="link_home">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['link_home']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['link_home']['value'], ['class'=>'form-control'])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
