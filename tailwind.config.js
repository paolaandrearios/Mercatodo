module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/scss/**/*.scss',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    experimental: {
        applyComplexClasses: true,
        darkModeVariant: true,
    },
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                orangePantone: '#FF5500',
                orangeRed: '#FF691F',
                gainsboroGray: '#DBDBDB',
                spanishGray: '#9C9C9C',
                dimGray: '#616161',
                atomicTangerine: '#FF925C',
                culturedGray: '#F5F5F5',
                greenTem: '#34e718',
                greenTemLight: '#9AF38C',
                yellowLight: '#FDE58A',
                seashell: '#FFF1EB',
            },
            fontFamily: {
                poppins: "'Poppins', sans-serif",
            },
        },
    },
    variants: {
        boxShadow: ['responsive', 'hover', 'focus', 'active'],
    },
    plugins: [
        require('@tailwindcss/ui'),
        require('@tailwindcss/nesting'),
        require('autoprefixer'),
        require('tailwindcss-dark-mode')(),
    ],
};
