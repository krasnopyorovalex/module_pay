DASHBOARD.namespace('DASHBOARD.transliterate');
DASHBOARD.transliterate = (function () {
    return {
        start: function (text) {
            var space = '-';
            // Берем значение из нужного поля и переводим в нижний регистр
            text = text.toLowerCase();

            // Массив для транслитерации
            var transl = {
                'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
                'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
                'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
                'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': 'y', 'ы': 'y', 'ь': 'y', 'э': 'e', 'ю': 'yu', 'я': 'ya',
                ' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
                '#': space, '$': space, '%': space, '^': space, '&': space, '*': space,
                '(': space, ')': space,'-': space, '\=': space, '+': space, '[': space,
                ']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
                '{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
                '?': space, '<': space, '>': space, '№':space
            };

            var result = '',
            current_sim = '',
                i = 0;

            for(i; i < text.length; i++) {
                // Если символ найден в массиве то меняем его
                if(transl[text[i]] != undefined) {
                    if(current_sim != transl[text[i]] || current_sim != space){
                        result += transl[text[i]];
                        current_sim = transl[text[i]];
                    }
                }
                // Если нет, то оставляем так как есть
                else {
                    result += text[i];
                    current_sim = text[i];
                }
            }

            result = result.replace(/^-/, '');
            return result.replace(/-$/, '');
        }
    }
})();