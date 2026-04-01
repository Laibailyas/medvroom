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
                    DEFAULT: '#ea580c', // orange-600
                    hover: '#f97316',   // orange-500
                },
                secondary: {
                    DEFAULT: '#059669', // emerald-600
                    hover: '#10b981',   // emerald-500
                },
                neutral: {
                    dark: '#0f172a',    // slate-900
                    light: '#f8fafc',   // slate-50
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
