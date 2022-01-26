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
            return window._asset + resource
        },
        __e: function __e(object, key) {
            if(!object){
                return [];
            }
            return object[key];
        },
    },
}
