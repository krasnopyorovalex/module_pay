jQuery(function(){
    /*
     |-----------------------------------------------------------
     |   comment text
     |-----------------------------------------------------------
     */
    var form = jQuery('#form'),
        origForm = form.serialize();
    jQuery('#return').on('click', function() {
        if(form.serialize() !== origForm) {
            return confirm('Вы внесли изменения, но не сохранили, вернуться к списку?');
        }
    });


    /*
     |-----------------------------------------------------------
     |   Транслитерация alias'а по требованию
     |-----------------------------------------------------------
     */
    var transliterate = DASHBOARD.transliterate,
        input = jQuery('#transliterate__input'),
        box = jQuery('.box-content');
    box.on('click','.icon-refresh', function () {
        var value = transliterate.start(input.val());
        return jQuery(this).prev('input').val(value);
    });

    /*
     |-----------------------------------------------------------
     |   Вешаем на textarea редактор ckeditor
     |-----------------------------------------------------------
     */
    if (typeof jQuery('textarea').ckeditor === 'function'){
        jQuery('textarea').not('textarea.off_ckeditor').ckeditor();
    }

    /*
     |-----------------------------------------------------------
     |   Удаление изображение
     |-----------------------------------------------------------
     */
    var btn_action = jQuery('#remove_image'),
        action     = window.location.pathname.replace('update','remove-image');
    btn_action.on('click', function () {
        if(confirm('Вы уверены, что хотите удалить изображение?')){
            var _this = jQuery(this);
            return $.ajax({
                url: action,
                type: "POST",
                success: function() {
                    return _this.closest('div.thumbnail').fadeOut() && Growl.info({
                            title: 'Уведомление!',
                            text: 'Изображение успешно удалено'
                        });
                }
            });
        }
    });

    /*
     |-----------------------------------------------------------
     |   form builder
     |-----------------------------------------------------------
     */
    var form_builder = jQuery('#form_builder'),
        form_build   = jQuery('#form_build'),
        save_form    = jQuery('#save_form'),
        json_schema  = jQuery('#json_schema');
    form_builder.on('click','button', function (e) {
        e.preventDefault();
        var action = jQuery(this).attr('data-action');
        return form_build.append(DASHBOARD.form_builder['template'](action,'','','',''));
    });
    form_build.on('click', '.label-black', function () {
        return jQuery(this).parent('div.box').remove();
    });
    form_build.on('click', '.btn', function (e) {
        e.preventDefault();
        if(jQuery(this).hasClass('btn-red')){
            jQuery(this).closest('.box').find('.fields input:last-child').remove();
        } else {
            jQuery(this).closest('.box').find('.fields').append(DASHBOARD.form_builder.option(''));
        }
    });

    save_form.on('click', function () {
        return jQuery('#json_schema').val(DASHBOARD.form_builder.json_schema(form_build));
    });

    /*
     |-----------------------------------------------------------
     |   рисуем форму, если существует
     |-----------------------------------------------------------
     */
    if(typeof json_schema.val() != 'undefined' && json_schema.val().length){
        json_schema = JSON.parse(json_schema.val());
        //console.log(json_schema);
        for(var prop in json_schema){
            var type = json_schema[prop]['type'],
                labelName = json_schema[prop]['label'],
                className = json_schema[prop]['className'],
                placeholder = json_schema[prop]['placeholder'] || '',
                required = json_schema[prop]['required'],
                options = json_schema[prop]['options'];
            form_build.append(DASHBOARD.form_builder['template'](type,labelName,className,placeholder,required,options));
        }
    }

    /*
     |-----------------------------------------------------------
     |   Показать выпадающий список для выбора ссылки
     |-----------------------------------------------------------
     */
    var navigation_box = jQuery('.navigation_box'),
        menuitems_link = jQuery('#menuitems-link'),
        op_list = jQuery('.field-menuitems-options');
    navigation_box.on('click','.icon-link',function () {
        return op_list.show();
    });
    op_list.on('change', 'select', function () {
        return menuitems_link.val((jQuery(this).val()));
    });
    menuitems_link.on('blur',function () {
        var string = jQuery(this).val();
        return string[0] != '/' ? jQuery(this).val('/' + string.replace('index','')) : jQuery(this).val(string.replace('index',''));
    });

    /*
     |-----------------------------------------------------------
     |   gallery
     |-----------------------------------------------------------
     */
    $( "#thumbs > ul" ).sortable({
        stop: function( event, ui ) {
            var to_server = [];
            jQuery(this).find('a').each(function(i){
                to_server[i] = jQuery(this).attr('data-id');
            });
            var pathname = window.location.pathname.split('/');
            if(pathname[3] == 'product'){
                pathname[2] = pathname[2] + '/' + pathname[3];
            }
            $.post("/_root/"+pathname[2]+"/update-positions", {values: to_server}, function(){
                Growl.info({title: "Уведомление",text: "Порядок отображения изменён успешно!"});
            });
        }
    });
    var editImageBox = jQuery('#edit-image'),
        imageBox = jQuery('#image_box');

    imageBox.on('click', '#thumbs .icon-edit', function () {
        $.post(jQuery(this).attr('data-link'), function(data){
            return editImageBox.html(data);
        });
    });
    imageBox.on('click', '.icon-remove', function () {
        var _this = jQuery(this);
        if(confirm('Вы уверены, что хотите удалить?')) {
            return removeImage(_this);
        }
    });
    editImageBox.on('click', '#edit_image_button', function (e) {
        e.preventDefault();
        return jQuery.ajax({
            url: jQuery(this).closest('form').attr('action'),
            type: "POST",
            dataType: "json",
            data: jQuery(this).closest('form').serialize(),
            success: function(data) {
                editImageBox.modal('hide');
                Growl.info({title: 'Сообщение из конторы',text: 'Информация об изображении сохранена успешно'});
                return imageBox.html(data);
            }
        });
    });

    /*
     |-----------------------------------------------------------
     |   gallery COPY, MOVE
     |-----------------------------------------------------------
     */
    var groupActions = jQuery('#group__actions'),
        galleries__list = jQuery('.galleries__list'),
        btn_a = jQuery('.btn_action'),
        images = [],
        box__galleries_list = jQuery('.box__galleries_list');
    groupActions.on('change', function (e) {
        e.preventDefault();
        var _this = jQuery(this);
        switch (_this.val()) {
            case 'check_all':
                imageBox.find(':checkbox').attr('checked',true);
                break;
            case 'copy-checked':
                galleries__list.removeClass('hidden');
                btn_a.removeClass('hidden');
                break;
            case 'move-checked':
                galleries__list.removeClass('hidden');
                btn_a.removeClass('hidden');
                break;
            case 'remove-checked':
                btn_a.removeClass('hidden');
                break;
        }
    });
    box__galleries_list.on('click', 'button', function (e) {
        e.preventDefault();
        images = [];
        imageBox.find('input:checked').each(function() {
            return images.push(parseInt(jQuery(this).attr('data-id')));
        });
        if(images.length){
            jQuery.post(window.location.pathname.replace('update',groupActions.val()),{
                'data': images,
                'gallery_to': parseInt(jQuery('.gallery_id').val())
            },function (data) {
                imageBox.html(data);
                return Growl.info({title: 'Сообщение из конторы',text: 'Действие выполнено успешно!'});
            });
        }
    });

    /*
     |-----------------------------------------------------------
     |   Сортировка строк в таблице
     |-----------------------------------------------------------
     */
    var table = jQuery('.table-sortable tbody');
    table.sortable({
        revert: true,
        items: "tr",
        cursor: "move",
        opacity: ".5",
        handle: ".icon-move",
        stop: function(event, ui) {
        jQuery.post(window.location.pathname + '/update-pos',{data:table.sortable("toArray")},function () {
            table.find('tr').each(function (i) {
                return jQuery(this).find('input').val(i);
            });
            return Growl.info({title: 'Сообщение из конторы',text: 'Порядок сохранён успешно!'});
        });
    }});

    /*
     |-----------------------------------------------------------
     |   reviews images
     |-----------------------------------------------------------
     */
    var reviews_actions = jQuery('#reviews .actions');
    reviews_actions.on('click','i',function () {
        var _this = jQuery(this);
        ///////////
        if(_this.attr('data-link').indexOf('remove') != -1){
            if(confirm('Вы уверены, что хотите удалить?')){
                return removeImage(_this) && Growl.info({title: 'Сообщение из конторы',text: 'Изображение удалено успешно'});
            }
        } else {
            jQuery.post(_this.attr('data-link'),function (data) {
                return editImageBox.html(data);
            });
        }
    });

    /*
     |-----------------------------------------------------------
     |   left navigation
     |-----------------------------------------------------------
     */
    var sidebar_li = jQuery('.primary-sidebar li > a'),
        pathname = window.location.pathname.replace(/\/add|\/delete\/(\d+)|\/product\/list\/(\d+)|\/product\/list\/(\d+)|\/delete-item\/(\d+)|\/edit-item\/(\d+)|\/items\/(\d+)|\/update\/(\d+)/g,'');
    sidebar_li.each(function(){
        if(jQuery(this).attr('href') == pathname){
            return jQuery(this).closest('.dark-nav').addClass('active') && jQuery(this).closest('.dark-nav > ul').addClass('in') && jQuery(this).parent('li').addClass('active');;
        }
    });

});

function removeImage(image) {
    jQuery.post(image.attr('data-link'), function () {
        return jQuery('#image_' + image.attr('data-id')).remove();
    });
}