<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model \common\models\Rooms */
?>
<div class="box-content" id="rooms_images">
    <div id="thumbs">
        <?= Html::ul($model->roomsImages, ['item' => function($item) {
            $actions = Html::tag('i','',['class' => 'icon-move']) .
                       Html::tag('i','',['class' => 'icon-edit', 'data-toggle' => 'modal', 'href' => '#edit-image', 'data-link' => Url::toRoute(['default/image-edit', 'id' => $item['id']])]) .
                       Html::tag('i','',['class' => 'icon-remove', 'data-id' => $item['id'], 'data-link' => Url::toRoute(['default/image-remove', 'id' => $item['id']])]);
            return Html::tag(
                'li',
                Html::a(Html::img('@rooms/'.$item['room_id'].'/'.$item['basename'].'_250_170.'.$item['ext']),
                    Url::to('@rooms/'.$item['room_id'].'/'.$item['basename'].'.'.$item['ext']),[
                        'data-id' => $item['id']
                    ]).Html::tag('div',$actions,['class' => 'actions']),
                [
                    'class' => $item['publish'] ? '' : 'unpublished',
                    'id' => 'image_' . $item['id']
                ]
            );
        }]) ?>
    </div>

</div>
<div class="clear"></div>