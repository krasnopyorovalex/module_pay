<div class="primary-sidebar">

    <!-- Main nav -->
    <ul class="nav navbar-collapse collapse navbar-collapse-primary">

        <li class="dark-nav">

            <span class="glow"></span>
            <a class="accordion-toggle collapsed " data-toggle="collapse" href="#yJ6h3Npe7C">
                <i class="icon-folder-open-alt icon-2x"></i>
	                    <span>
	                      Каталог
	                      <i class="icon-caret-down"></i>
	                    </span>
            </a>

            <ul id="yJ6h3Npe7C" class="collapse ">

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/rooms/default/index'])?>">
                        <i class="icon-list"></i> Номера
                    </a>
                </li>

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/rooms_attributes/default/index'])?>">
                        <i class="icon-font"></i> Атрибуты
                    </a>
                </li>

            </ul>

        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/periods/default/index'])?>">
                <i class="icon-calendar icon-2x"></i>
                <span>Периоды</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/discounts/default/index'])?>">
                <i class="icon-gift icon-2x"></i>
                <span>Скидки</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/payment_methods/default/index'])?>">
                <i class="icon-list-alt icon-2x"></i>
                <span>Способы оплаты</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/accommodation_options/default/index'])?>">
                <i class="icon-user icon-2x"></i>
                <span>Варианты размещения</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/tariffs/default/index'])?>">
                <i class="icon-money icon-2x"></i>
                <span>Тарифы</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/info_messages/default/index'])?>">
                <i class="icon-info-sign icon-2x"></i>
                <span>Инфосообщения</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/settings/default/index'])?>">
                <i class="icon-cog icon-2x"></i>
                <span>Настройки</span>
            </a>
        </li>

    </ul>
    
</div>