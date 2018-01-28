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
<body id="app">
<?php $this->beginBody() ?>
<header>
    <div>
        <div class="returned" v-if="checkedRoom" v-on:click.prevent="hideOrder()"  v-bind:class="{ loading: loading }">
            Вернуться к номерам
        </div>
        <!-- /.returned -->
        <?= Html::a(Html::img('/userfiles/'.$this->context->settings['logo'], ['alt' => 'Отель Сантурина', 'title' => 'Отель Сантурина']),$this->context->settings['link_home'])?>
        <span><?= $this->context->settings['phone']?></span>
    </div>
</header>

<?= $content?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter17190040 = new Ya.Metrika({
                    id:17190040,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/17190040" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>