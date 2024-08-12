import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                oswald: ['Oswald'],
            },
            colors: {
                'flamingo': '#e37f81',
                /*Añadida con https://uicolors.app*/
                'flamingo-paleta': {
                    '50': '#fcf4f4',
                    '100': '#fae6e6',
                    '200': '#f6d2d3',
                    '300': '#efb2b3',
                    '400': '#e37f81',
                    '500': '#d65d5f',
                    '600': '#c14144',
                    '700': '#a23335',
                    '800': '#872d2f',
                    '900': '#712b2c',
                    '950': '#3c1314',
                },

            },
            borderWidth: {
                DEFAULT: '1px',
                '0': '0',
                '2': '2px',
                '3': '3px',
                '4': '4px',
                '6': '6px',
                '8': '8px',
            },
            boxShadow: {
                '3xl': '0 20px 20px 5px rgba(0, 0, 0, 0.7)',
                'bajera': '0 5px 3px 0 rgba(0, 0, 0, 0.5)',
            }
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};
