module.exports = {
    methods: {
        /**
         * Translate the given key.
         */
        __(key, replace) {
            let translation, translationNotFound = true

            try {
                translation = key.split('.').reduce((t, i) => t[i] || null, window._translations[window._locale].php)

                if (translation) {
                    translationNotFound = false
                }
            } catch (e) {
                translation = key
            }

            if (translationNotFound) {
                translation = window._translations[window._locale]['json'][key]
                    ? window._translations[window._locale]['json'][key]
                    : key
            }

            /*_.forEach(replace, (value, key) => {
                translation = translation.replace(':' + key, value)
            })*/

            return translation
        },
        __locale() {
            return window._locale
        },
        __asset: function __asset(resource) {
            if(typeof resource === 'string'){
                return window._asset + resource
            }
            if(typeof resource === 'object'){
                return URL.createObjectURL(resource)
            }
            return '';
        },
        __e: function __e(object, key) {
            if(!object){
                return [];
            }
            return object[key];
        },
        __isEmpty: function __isEmpty(obj) {
            return obj && Object.keys(obj).length === 0 && Object.getPrototypeOf(obj) === Object.prototype;
        },

        __currencyFormat: function __currencyFormat(num) {
            const format = { style: 'currency', currency: 'COP' };
            const numberFormat = new Intl.NumberFormat('es-CO', format);
            return numberFormat.format(num);
        },

    },
}
