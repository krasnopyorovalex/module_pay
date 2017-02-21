<?php
use frontend\assets\AppAsset;
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Модуль бронирования для сайта</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <div>
        <?= Html::img('/userfiles/'.$this->context->settings['logo'], ['alt' => 'Отель Сантурина', 'title' => 'Отель Сантурина'])?>
        <span><?= $this->context->settings['phone']?></span>
    </div>
</header>

<?= $content?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>