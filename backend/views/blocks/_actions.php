<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="form-actions">
    <?= Html::submitButton($this->context->action->id == 'delete' ? 'Удалить' : 'Сохранить', [
        'class' => $this->context->action->id == 'delete' ? 'btn btn-danger' :'btn btn-primary',
        'rel' => 'tooltip',
        'data-original-title' => $this->context->action->id == 'delete' ? 'Удалить и вернуться к списку' : 'Сохранить и вернуться к списку'
    ]) ?>
    <?= Html::a('Вернуться', Url::toRoute(["/{$this->context->module->id}"]), [
        'class' => 'btn btn-green',
        'id' => 'return',
        'rel' => 'tooltip',
        'data-original-title' => 'Вернуться к списку'
    ])?>
</div>