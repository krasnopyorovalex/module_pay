<?php
use yii\helpers\Html;
?>
<nav class="navbar navbar-default navbar-inverse navbar-static-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand" href="<?= Yii::$app->homeUrl?>">Панель управления</a>


        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-primary">
            <span class="sr-only">Toggle Side Navigation</span>
            <i class="icon-th-list"></i>
        </button>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-top">
            <span class="sr-only">Toggle Top Navigation</span>
            <i class="icon-align-justify"></i>
        </button>

    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-collapse-top">
        <div class="navbar-right">

            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle dropdown-avatar" data-toggle="dropdown">
                      <span>
                        <?= Html::img('@dashboard/images/avatars/avatar3.jpg',['class' => 'menu-avatar'])?> <span>Администратор <i class="icon-caret-down"></i></span>
                      </span>
                    </a>
                    <ul class="dropdown-menu">

                        <!-- the first element is the one with the big avatar, add a with-image class to it -->

                        <li class="with-image">
                            <div class="avatar">
                                <?= Html::img('@dashboard/images/avatars/avatar3.jpg')?>
                            </div>
                            <span>Администратор</span>
                        </li>

                        <li class="divider"></li>

                        <li><a href="#"><i class="icon-user"></i> <span>Профиль</span></a></li>
                        <li><?= Html::a(Html::tag('i','',['class' => 'icon-off']).Html::tag('span',' Выйти'), \yii\helpers\Url::toRoute('/site/logout'),[
                                'data-method' => 'post',
                            ])?></li>
                    </ul>
                </li>
            </ul>
        </div>


    </div>
    <!-- /.navbar-collapse -->


</nav>
<div class="sidebar-background">
    <div class="primary-sidebar-background"></div>
</div>