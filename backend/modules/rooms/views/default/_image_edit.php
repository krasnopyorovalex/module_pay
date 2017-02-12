<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model \common\models\RoomsImages */
?>
<div class="modal-dialog">
    <div class="modal-content">
        <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['class' => 'fill-up']]); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Редактирование информации</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 form-edit">
                        <?= $form->field($model, 'name') ?>
                        <?= $form->field($model, 'alt') ?>
                        <?= $form->field($model, 'title') ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue', 'id' => 'edit_image_button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->