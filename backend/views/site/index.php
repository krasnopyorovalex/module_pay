<div class="container site-index">
    <div class="action-nav-normal action-nav-line">
        <div class="row action-nav-row">
            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/rooms/default/index'])?>" title="Номера">
                    <i class="icon-list"></i>
                    <span>Номера</span>
                </a>
            </div>

            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/periods/default/index'])?>" title="Периоды">
                    <i class="icon-calendar"></i>
                    <span>Периоды</span>
                </a>
            </div>

            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/discounts/default/index'])?>" title="Скидки">
                    <i class="icon-gift"></i>
                    <span>Скидки</span>
                </a>
            </div>

            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/tariffs/default/index'])?>" title="Тарифы">
                    <i class="icon-money"></i>
                    <span>Тарифы</span>
                </a>
            </div>

            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/payment_methods/default/index'])?>" title="Способы оплаты">
                    <i class="icon-list-alt"></i>
                    <span>Способы оплаты</span>
                </a>
            </div>

            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/accommodation_options/default/index'])?>" title="Варианты размещения">
                    <i class="icon-user"></i>
                    <span>Варианты размещения</span>
                </a>
            </div>

        </div>
    </div>
</div>