const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',

                black: "#171717",
                white: colors.white,
                gray: colors.trueGray,
                'gray-background': '#f7f7f7',
                'blue': '#2D7FEF',
                'blue-hover': '#2D7FEF',
                'yellow': '#FFCA28',
                'yellow-hover': '#FFCA28',
                'green': '#28A745',
                'red': '#DC3545',
                'purple': '#6F42C1',
            },
            maxWidth: {
                custom: '62.5rem',
            },
            spacing: {
                70: '17.5rem',
                175: '43.75rem',
            },
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};
