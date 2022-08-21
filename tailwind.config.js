const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './src/**/*.{html,js}',
        // './node_modules/tw-elements/dist/js/**/*.js',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary: '#FF6363',
                secondary: {
                    100: '#E2E2D5',
                    200: '#888883',
                }
            },
            fontFamily: {
                bree: ['Bree Serif'],
                trirong: ['Trirong'],
                exo: ['Exo']
            }
        },
    },
    variants: {

    },

    plugins: [
        // require('tw-elements/dist/plugin')

    ],
};
