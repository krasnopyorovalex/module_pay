<?php

use frontend\assets\VueAsset;

/* @var $this \yii\web\View */
/* @var $info_messages array */
/* @var $payment_methods array */
/* @var $tariffs array */
/* @var $accommodation_options array */
/* @var $max_count_adults integer */
/* @var $dateStart string */
/* @var $dateEnd string */

VueAsset::register($this);
?>
<div class="container" id="app">

    <div class="main__wrap" v-show="!checkedRoom">
        <div class="params-box" v-show="!checkedRoom">
            <form action="#" id="calculate-form">
                <div class="params-box_dates">
                    <div>
                        <label for="arrival-date">Дата заезда:</label>
                        <input type="text" id="arrival-date" name="arrivalDate" data-min_date="<?= $dateStart?>" data-max_date="<?= $this->context->settings['date_end']?>" value="<?= $dateStart?>">
                        <i class="icon-calendar"></i>
                    </div>
                    <div>
                        <label for="departure-date">Дата выезда:</label>
                        <input type="text" id="departure-date" name="departureDate" value="<?= $dateEnd?>">
                        <i class="icon-calendar"></i>
                    </div>
                </div>
                <!-- /.params-box_dates -->
                <div class="params-box_adults_childs">
                    <div>
                        <label for="years-above-11">Взрослых (c 11 лет):</label>
                        <i class="icon_minus"></i>
                        <input type="text" id="years-above-11" name="adultsChilds" maxlength="1" value="1" data-max-count="<?= $max_count_adults?>" data-min-count="1">
                        <i class="icon_plus"></i>
                    </div>
                    <?php if ($accommodation_options): ?>
                        <?php foreach ($accommodation_options as $ao): ?>
                            <div>
                                <label for="lf_<?= $ao->id?>"><?= $ao->name?></label>
                                <i class="icon_minus"></i>
                                <input type="text" id="lf_<?= $ao->id?>" name="accommodationOptions[<?= $ao->id?>]" maxlength="1" data-max-count="<?= $ao->max_count?>" data-min-count="0" value="0">
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
            <div class="rooms-box_item" v-for="(index, room) in rooms" v-show="room.priceFull">
                <div class="rooms-box_item_gallery_small_desc">
                    <div class="wrap-padded">
                        <div class="room-name" v-text="room.name"></div>
                        <div class="item_gallery">
                            <div class="owl-carousel owl-theme" v-owl>
                                <div class="item" v-for="image in room.roomsImages">
                                    <a :href="'/userfiles/rooms_gallery/' + room.id + '/'+ image.basename + '.' + image.ext" :rel="'group' + room.id">
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
                            <div class="small_desc_list_item" v-if="room.tariff">
                                <span>Тариф:</span>
                                <span><a :href="'#tariff-'+ room.tariff.id" class="info-popup">{{ room.tariff.name }}</a></span>
                            </div>
                            <div class="small_desc_list_item">
                                <span>Способ оплаты:</span>
                                <span class="payments_methods">
                                    <span v-for="item in room.paymentMethods">
                                        <a :href="'#payment_method-'+ item.id" class="info-popup">{{ item.name }}</a>
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
                            <div class="date-calendar">С {{ room.dateStart }} по {{ room.dateEnd }}</div>
                            <div class="count">Количество ночей: {{ room.diffDays }}</div>
                        </div>
                        <div class="change-dates">
                            <a href="#">Изменить даты</a>
                        </div>
                        <!-- /.change-dates -->
                        <div class="info-list">
                            <span>Взрослых (c 11 лет): {{ params.adultsChilds }}</span>
                            <span v-for="item in room.accommodationOptions">{{ item.name }}: {{ params.accommodationOptions[item.id] }}</span>
                        </div>
                        <!-- /.info-list -->
                        <div class="price-by-night">
                            <div class="discount" v-show="room.price">Средняя цена за ночь:  <span>{{ parseInt(room.price / room.diffDays) | currency '' 0 }} руб.</span></div>
                            <span v-show="!(room.price == room.priceFull)">{{ parseInt(room.priceFull / room.diffDays) | currency '' 0 }} руб.</span>
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.price-by-night -->
                        <div class="line-blue"></div>
                        <div class="economy-info">
                            <span v-show="!(room.price == room.priceFull)">{{ parseInt(room.priceFull) | currency '' 0 }} руб.</span>
                            <span v-show="!(room.price == room.priceFull)">Экономия {{ parseInt(room.priceFull - room.price) | currency '' 0 }} руб.</span>
                        </div>
                        <div class="clearfix"></div>
                        <!-- /.economy-info -->
                        <div class="total-price">
                            Итого: <span>{{ parseInt(room.price) | currency '' 0 }}</span> руб.
                        </div>
                        <!-- /.total-price -->
                        <div class="discounts-info">
                            <div v-for="item in room.discounts" v-html="item.description + ' - ' + item.value + '%'"></div>
                        </div>
                        <!-- /.discounts-info -->
                        <a class="booking-submit trim" href="#" v-on:click.prevent="showOrder(room)">
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

    <div class="order-template" v-if="checkedRoom" transition="expand">
        <div class="order-title">
            <i class="icon_order_title"></i>
            оформление заявки
        </div>
        <!-- /.order-title -->

        <div class="order-form">
            <form action="#" method="post" v-on:submit.prevent="onSubmit">
                <div class="left-sb">
                    <div class="wrap-padded">
                        <div>
                            <input type="text" placeholder="Имя Фамилия" v-model="name">
                            <i class="icon-order-user"></i>
                        </div>
                        <div>
                            <input type="email" placeholder="Е-mail" v-model="email">
                            <i class="icon-order-email"></i>
                        </div>
                        <div>
                            <input type="text" placeholder="Телефон" class="phone" v-model="phone" v-phone>
                            <i class="icon-order-phone"></i>
                        </div>
                        <div>
                            <label for="order-info">Дополнительные пожелания:</label>
                            <textarea name="" id="order-info" v-model="message"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /.left-sb -->
                <div class="right-sb">
                    <div class="wrap-padded">
                        <p><b>Заезд:</b> {{ checkedRoom.dateStart }}</p>
                        <p><b>Выезд:</b> {{ checkedRoom.dateEnd }}</p>
                        <p><b>Количество ночей:</b> {{ checkedRoom.diffDays }}</p>

                        <p><b>Категоря номера:</b> {{ checkedRoom.name }}</p>
                        <p><b>Взрослых:</b> {{ params.adultsChilds }}</p>
                        <p v-for="item in checkedRoom.accommodationOptions"><b>{{ item.name }}:</b> {{ params.accommodationOptions[item.id] }}</p>
                        <p><b>Тариф:</b> {{ checkedRoom.tariff.name }}</p>

                        <div class="middle-price-by-night">
                            Средняя цена за ночь:  <span v-show="!(checkedRoom.price == checkedRoom.priceFull)">{{ parseInt(checkedRoom.price / checkedRoom.diffDays) | currency '' 0 }} руб.</span>
                            <span v-show="!(checkedRoom.price == checkedRoom.priceFull)">{{ parseInt(checkedRoom.priceFull / checkedRoom.diffDays) | currency '' 0 }} руб.</span>
                        </div>
                        <div class="line-blue"></div>
                        <!-- /.middle-price-by-night -->
                        <div class="total-price">
                            <div>Итого: <span>{{ parseInt(checkedRoom.price) | currency '' 0 }} руб</span></div>
                            <div v-show="!(checkedRoom.price == checkedRoom.priceFull)">{{ parseInt(checkedRoom.priceFull) | currency '' 0 }} руб.</div>
                            <div v-show="!(checkedRoom.price == checkedRoom.priceFull)">Экономия {{ parseInt(checkedRoom.priceFull - checkedRoom.price) | currency '' 0 }} руб.</div>
                        </div>
                        <!-- /.total-price -->
                        <div class="clearfix"></div>
                        <div class="info-text">
                            <div v-for="item in checkedRoom.discounts" v-html="item.description + ' - ' + item.value + '%'"></div>
                        </div>
                        <!-- /.info-text -->
                        <button type="submit" class="btn-submit trim">отправить заявку</button>
                    </div>
                </div>
                <!-- /.right-sb -->
            </form>
        </div>
        <!-- /.order-form -->
    </div>
    <!-- /.order-template -->

    <div class="empty__message" v-if="!count">
        <?= $this->context->settings['empty_message']?>
    </div>
    <!-- /.empty__message -->

</div>

<?php if($info_messages):?>
    <?php foreach ($info_messages as $im):?>
        <div id="info-<?= $im->id?>" class="info-message">
            <?= $im->description?>
        </div>
        <!-- /#info-<?= $im->id?> -->
    <?php endforeach;?>
<?php endif;?>

<?php if($tariffs):?>
    <?php foreach ($tariffs as $tariff):?>
        <div id="tariff-<?= $tariff->id?>" class="info-message">
            <?= $tariff->description?>
        </div>
        <!-- /#tariff-<?= $tariff->id?> -->
    <?php endforeach;?>
<?php endif;?>

<?php if($payment_methods):?>
    <?php foreach ($payment_methods as $payment_method):?>
        <div id="payment_method-<?= $payment_method->id?>" class="info-message">
            <?= $payment_method->description?>
        </div>
        <!-- /#payment_method-<?= $payment_method->id?> -->
    <?php endforeach;?>
<?php endif;?>