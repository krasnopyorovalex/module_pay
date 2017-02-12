<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\Tariffs */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\components\IconHelper;
$this->params['breadcrumbs'][] = $this->context->module->params['name'];
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title"><?= $this->context->module->params['name']?></span></div>
                <div class="box-content padded">
                    <div id="dataTables">
                        <?php echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'summary' => false,
                            'tableOptions' => ['class' => 'table responsive'],
                            'columns' => [
                                'date_start:date',
                                'date_end:date',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Действия',
                                    'template' => '{update} {delete}',
                                    'buttons' => [
                                        'update' => function($url){
                                            return Html::a(Html::tag('i','',['class' => 'icon-pencil']), $url,[
                                                'rel' => 'tooltip',
                                                'data-original-title' => 'Редактировать'
                                            ]);
                                        },
                                        'delete' => function($url){
                                            return Html::a(Html::tag('i','',['class' => 'icon-remove']), $url,[
                                                'rel' => 'tooltip',
                                                'data-original-title' => 'Удалить'
                                            ]);
                                        }
                                    ],
                                ],
                            ],
                        ]);
                        echo Html::tag('div', Html::a('Добавить', Url::toRoute(["/{$this->context->module->id}/add"]), ['class' => 'btn btn-blue']),[
                            'class' => 'padded'
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>