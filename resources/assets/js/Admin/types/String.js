/**
 * Translit
 *
 **/
String.prototype.translit = (function() {
    var L = {
            'А': 'A',
            'а': 'a',
            'Б': 'B',
            'б': 'b',
            'В': 'V',
            'в': 'v',
            'Г': 'G',
            'г': 'g',
            'Д': 'D',
            'д': 'd',
            'Е': 'E',
            'е': 'e',
            'Ё': 'Yo',
            'ё': 'yo',
            'Ж': 'Zh',
            'ж': 'zh',
            'З': 'Z',
            'з': 'z',
            'И': 'I',
            'и': 'i',
            'Й': 'Y',
            'й': 'y',
            'К': 'K',
            'к': 'k',
            'Л': 'L',
            'л': 'l',
            'М': 'M',
            'м': 'm',
            'Н': 'N',
            'н': 'n',
            'О': 'O',
            'о': 'o',
            'П': 'P',
            'п': 'p',
            'Р': 'R',
            'р': 'r',
            'С': 'S',
            'с': 's',
            'Т': 'T',
            'т': 't',
            'У': 'U',
            'у': 'u',
            'Ф': 'F',
            'ф': 'f',
            'Х': 'Kh',
            'х': 'kh',
            'Ц': 'Ts',
            'ц': 'ts',
            'Ч': 'Ch',
            'ч': 'ch',
            'Ш': 'Sh',
            'ш': 'sh',
            'Щ': 'Sch',
            'щ': 'sch',
            'Ъ': '',
            'ъ': '',
            'Ы': 'Y',
            'ы': 'y',
            'Ь': '',
            'ь': '',
            'Э': 'E',
            'э': 'e',
            'Ю': 'Yu',
            'ю': 'yu',
            'Я': 'Ya',
            'я': 'ya',
            'ї': 'i',
            'і': 'i',
            ' ': '_',
            ',': '',
            '.': '',
            ';': '',
            ':': '',
            '!': '-',
            '?': '-',
            '@': '-',
            '#': '-',
            '%': '-',
            '&': '-',
            '*': '-',
            '(': '-',
            ')': '-',
            '=': '-',
            '+': '-',
            '/': '-',
            // '\\': '-',
            '{': '',
            '}': '',
            '\'': '',
            '"': '',
            '<': '',
            '>': '',
            '»': '',
            '«': '',
        },
        r = '',
        k;

    for (k in L) r += k;

    r = new RegExp('[' + r + ']', 'g');

    k = function(a) {
        return a in L ? L[a] : '';
    };

    return function() {
        return this.toLowerCase().trim().replace(r, k);
    };
})();


/**
 * A simple "sprintf" implementation for javascript
 *  %s - represents a string
 *  %n - represents a number
 *  %b - represents a boolean
 *
 * @type {Function}
 */
String.prototype.sprintf =
    String.prototype.sprintf || function () {
        var str = this.toString();
        for (var i = 0; i < arguments.length; i++) {
            var arg = arguments[i],
                type = typeof(arg);
            if ('string' === type) {
                str = str.replace(/%s/, arg);
            } else if ('number' === type) {
                str = str.replace(/%n/, arg);
            } else if ('boolean' == type) {
                str = str.replace(/%b/, arg ? 'true' : 'false');
            }
        }
        return str;
    };