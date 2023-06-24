const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.indigo,
                secondary: colors.teal,
                neutral:colors.slate,
                danger:colors.red,
                success:colors.green,
                warning:colors.yellow,
              },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
