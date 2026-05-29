import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
    extend: {
        fontFamily: {
            sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        },
        colors: {
            zen: {
                'light': '#E8F3C9',    
                'base': '#D1E69F',     
                'dark': '#6E8A37',     
                'green': '#A7CFB4',    
                'yellow': '#D6D58E',   
            },
        },
    },
},

    plugins: [forms],
};
