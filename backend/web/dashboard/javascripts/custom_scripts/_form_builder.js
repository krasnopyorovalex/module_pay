DASHBOARD.namespace('DASHBOARD.form_builder');
DASHBOARD.form_builder = (function () {
    return {
        option: function (value) {
            return '<input type="text" class="option" value="'+value+'">';
        },
        create_options: function (options) {
            var html = '';
            if(options){
                for(var opt in options){
                    html += this.option(options[opt]['value']);
                }
            }
            return html;
        },
        template: function (type, labelName, className, placeholder, required, options) {
            required = (required ? 'checked' : '');
            options = options ? this.create_options(options) : '<input type="text" class="option" value="">';
            var template = ['<div class="box" data-type="'+type+'"><span class="label label-black" title="Удалить">[x]</span>',
                '<span class="name">'+this.types(type)+'</span>',
                '<label>Метка</label>',
                '<input type="text" value="'+labelName+'" class="labelName"/>',
                '<label>Placeholder</label>',
                '<input type="text" value="'+placeholder+'" class="placeholder"/>',
                '<label>css-класс</label>',
                '<input type="text" class="className" value="'+className+'">',
                '<label>Обязательное поле?</label>',
                '<input type="checkbox" class="required" '+required+'>'
            ];

            if(type == 'select' || type == 'checkbox' || type == 'radio'){
                template.push('<div>Варианты опций:</div>',
                                '<div class="fields">',options,'</div>',
                                '<button class="btn btn-xs btn-default">Добавить</button><button class="btn btn-xs btn-red">Удалить</button>',
                                '<div class="clearfix"></div>',
                                '</div>');
            } else {
                template.push('<div class="clearfix"></div>','</div>');
            }
            return template.join('');
        },
        types: function (type) {
            var types = {
                'input': 'Тип - «input»',
                'select': 'Тип - «select»',
                'checkbox': 'Тип - «checkbox»',
                'radio': 'Тип - «radio»',
                'textarea': 'Тип - «textarea»'
            };
            return types[type];
        },
        json_schema: function (box) {
            var container = {};
            box.find('.box').each(function (i) {
                var _this= jQuery(this),
                    field_name = 'field_' + i;
                container[field_name] = {};
                container[field_name] = {
                    'type': _this.attr('data-type'),
                    'label': _this.find('.labelName').val(),
                    'required': _this.find('.required').prop('checked'),
                    'className': _this.find('.className').val(),
                    'placeholder': _this.find('.placeholder').val()
                };
                if(_this.find('.fields').length){
                    container[field_name]['options'] = {};
                    _this.find('.fields input').each(function (i) {
                        var option = 'option_' + i;
                        container[field_name]['options'][option] = {
                            'value': jQuery(this).val()
                        };
                    });
                }
            });

            return JSON.stringify(container);
        }
    }
})();