<?php
use yii\widgets\Breadcrumbs;
?>
<div class="container padded">
    <div class="row">
        <?= Breadcrumbs::widget([
            'itemTemplate' => '<div class="breadcrumb-button blue"><span class="breadcrumb-label"> {link}</span><span class="breadcrumb-arrow"><span></span></span></div>',
            'activeItemTemplate' => '<div class="breadcrumb-button"><span class="breadcrumb-label"> {link}</span><span class="breadcrumb-arrow"><span></span></span></div>',
            'tag' => 'div',
            'options' => ['id' => 'breadcrumbs'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>