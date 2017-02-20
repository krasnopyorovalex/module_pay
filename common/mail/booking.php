<?php

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */

?>
<p><b>Данные заказика:</b></p>
<p>Имя: <?= $model['name']?></p>
<p>Email: <?= $model['email']?></p>
<p>Телефон: <?= $model['phone']?></p>
<p>Дополнительные пожелания: <?= $model['message']?></p>
<p>------------------</p>
<p><b>Данные бронирования</b></p>
<p>Заезд: <?= Yii::$app->formatter->asDate($model['params']['arrivalDate'],'long')?></p>
<p>Выезд: <?= Yii::$app->formatter->asDate($model['params']['departureDate'],'long')?></p>
<p>Количество ночей: <?= $model['diffDays']?></p>
<p>Категоря номера: <?= $model['room']['name']?></p>
<p>Взрослых: <?= $model['params']['adultsChilds']?></p>

<?php
    foreach ($model['room']['accommodationOptions'] as $ao)
    {
        if(isset($model['params']['accommodationOptions'][$ao['id']]))
        { ?>
          <p><?= $ao['name']?>: <?= $model['params']['accommodationOptions'][$ao['id']]?></p>
        <?php }
    }
?>

<p>Тариф: <?= $model['room']['tariff']['name']?></p>
<p>Цена: <?= $model['price']?> руб.</p>
