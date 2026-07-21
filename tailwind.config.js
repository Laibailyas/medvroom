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
            colors: {
                primary: {
                    DEFAULT: '#003CFB', // Brand Blue
                    hover: '#1D4FFF',   // Lighter Blue
                    dark: '#002ECC',    // Dark Blue
                    light: '#EAF0FF',   // Very Light Blue
                },

                secondary: {
                    DEFAULT: '#0F172A', // Slate-900 (almost black)
                    hover: '#1E293B',   // Slate-800
                },

                neutral: {
                    dark: '#0F172A',
                    light: '#F8FAFC',
                    border: '#E2E8F0',
                }
            },

           fontFamily: {
    sans: ['Inter', ...defaultTheme.fontFamily.sans],
},
        },
    },

    plugins: [forms],
};