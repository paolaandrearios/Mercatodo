module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/scss/**/*.scss',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
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
            seashell: '#FFF1EB',
        },
        fontFamily: {
            poppins: "'Poppins', sans-serif",
        }
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
    require('@tailwindcss/nesting'),
    require('autoprefixer')
  ],
    experimental: {
      applyComplexClasses: true,
    },
}
