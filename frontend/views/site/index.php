<?php

use frontend\assets\VueAsset;

/* @var $this \yii\web\View */
/* @var $info_messages array */
/* @var $accommodation_options array */
/* @var $max_count_adults integer */

VueAsset::register($this);
?>
<div class="container">
    <div class="params-box">
        <form action="#" id="calculate-form">
            <div class="params-box_dates">
                <div>
                    <label for="arrival-date">Дата заезда:</label>
                    <input type="text" id="arrival-date"">
                    <i class="icon-calendar"></i>
                </div>
                <div>
                    <label for="departure-date">Дата выезда:</label>
                    <input type="text" id="departure-date">
                    <i class="icon-calendar"></i>
                </div>
            </div>
            <!-- /.params-box_dates -->
            <div class="params-box_adults_childs">
                <div>
                    <label for="years-above-11">Взрослых (c 11 лет):</label>
                    <i class="icon_minus"></i>
                    <input type="text" id="years-above-11" maxlength="2" value="1" data-max-count="<?= $max_count_adults?>" disabled>
                    <i class="icon_plus"></i>
                </div>
                <?php if ($accommodation_options): ?>
                    <?php foreach ($accommodation_options as $ao): ?>
                        <div>
                            <label for="lf_<?= $ao->id?>"><?= $ao->name?></label>
                            <i class="icon_minus"></i>
                            <input type="text" id="lf_<?= $ao->id?>" maxlength="2" data-max-count="<?= $ao->max_count?>" value="0" disabled>
                            <i class="icon_plus"></i>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- /.params-box_adults_childs -->
            <div class="params-box_calculate_cost">
                <div class="calculate trim" v-on:click="getAllRooms">
                    <i class="icon icon-rub"></i> <span v-bind:class="{ loading: loading }">Просчитать стоимость</span>
                    <div class="spinner" v-show="loading">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                </div>
            </div>
            <!-- /.params-box_calculate_cost -->
        </form>
    </div>
    <!-- /.params-box -->

    <?php if($info_messages):?>
        <div class="info-box">
            <?php foreach ($info_messages as $im):?>
                <div class="info-box-item">
                    <i class="icon <?= $im->icon?>"></i>
                    <a href="#info-<?= $im->id?>" class="info-popup"><?= $im->name?></a>
                </div>
            <?php endforeach;?>
        </div>
        <!-- /.info-box -->
    <?php endif;?>

    <div class="rooms-box" v-bind:class="{ loading: loading }">
        <div class="rooms-box_item" v-for="room in rooms">
            <div class="rooms-box_item_gallery_small_desc">
                <div class="wrap-padded">
                    <div class="room-name" v-text="room.name"></div>
                    <div class="item_gallery">
                        <div class="owl-carousel owl-theme" v-owl>
                            <div class="item" v-for="image in room.roomsImages">
                                <a href="/userfiles/rooms_gallery/{{ room.id }}/{{ image.basename }}.{{ image.ext }}" rel="group{{ room.id }}">
                                    <img :src="'/userfiles/rooms_gallery/' + room.id + '/' + image.basename + '_250_170.' + image.ext" alt="alt">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.item_gallery -->
                    <div class="small_desc">
                        <div class="title">В Номере</div>
                        <div class="small_desc_list_item" v-for="(index, item) in room.roomsAttributesVias">
                            <span>{{ room.roomsAttributes[index].name }}:</span>
                            <div v-html="item.value"></div>
                        </div>
                        <div class="small_desc_list_item" v-show="room.tariff">
                            <span>Тариф:</span>
                            <span><a href="#" v-text="room.tariff.name"></a></span>
                        </div>
                        <div class="small_desc_list_item">
                            <span>Способ оплаты:</span>
                            <span class="payments_methods">
                                <span v-for="item in room.paymentMethods">
                                    <a href="#">{{ item.name }}</a>
                                </span>
                            </span>
                        </div>
                    </div>
                    <!-- /.small_desc -->
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="rooms-box_item_full_desc">
                <div class="wrap-padded">
                    <div class="dates">
                        <div class="date-calendar">С 27 октября по 31 октября</div>
                        <div class="count">Количество ночей: 3</div>
                    </div>
                    <div class="change-dates">
                        <a href="#">Изменить даты</a>
                    </div>
                    <!-- /.change-dates -->
                    <div class="info-list">
                        <span v-for="item in room.accommodationOptions">{{ item.name }}: 0</span>
                    </div>
                    <!-- /.info-list -->
                    <div class="price-by-night">
                        <div class="discount">Средняя цена за ночь:  <span>1 650 руб.</span></div>
                        <span>2 000 руб.</span>
                        <div class="clearfix"></div>
                    </div>
                    <!-- /.price-by-night -->
                    <div class="line-blue"></div>
                    <div class="economy-info">
                        <span>1 950 руб.</span>
                        <span>Экономия 239 руб.</span>
                    </div>
                    <div class="clearfix"></div>
                    <!-- /.economy-info -->
                    <div class="total-price">
                        Итого: <span>5 550</span> руб.
                        <i class="icon-info"></i>
                    </div>
                    <!-- /.total-price -->
                    <div class="discounts-info">
                        <div v-for="item in room.discounts" v-html="item.description + ' - ' + item.value + '%'"></div>
                    </div>
                    <!-- /.discounts-info -->
                    <a class="booking-submit trim" href="/#">
                        оформить заявку
                    </a>
                    <!-- /.booking-submit -->
                </div>
            </div>
        </div>
        <!-- /.rooms-box_item -->
    </div>
    <!-- /.rooms-box -->
</div>

<?php if($info_messages):?>
    <?php foreach ($info_messages as $im):?>
        <div id="info-<?= $im->id?>" class="info-message">
            <?= $im->description?>
        </div>
        <!-- /#info-<?= $im->id?> -->
    <?php endforeach;?>
<?php endif;?>