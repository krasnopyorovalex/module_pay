<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>Админинистративная панель</title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <?= !Yii::$app->user->isGuest ? $this->render('@app/views/blocks/_top_search') : ''?>
    <?= !Yii::$app->user->isGuest ? $this->render('@app/views/blocks/_left_sidebar') : ''?>

    <div class="main-content">

        <?= !Yii::$app->user->isGuest ? $this->render('@app/views/blocks/_top_sidebar') : ''?>
        <?= !Yii::$app->user->isGuest ? $this->render('@app/views/blocks/_breadcrumbs') : ''?>
        <?= $content?>
        
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>


