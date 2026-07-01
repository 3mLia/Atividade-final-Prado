import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    // Ativa o modo escuro baseado em classe
    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Nossa paleta Barbearia
                barber: {
                    dark: '#111111',       // Fundo principal
                    card: '#1a1a1a',       // Fundo do card
                    gold: {
                        DEFAULT: '#f59e0b', // text-amber-500
                        hover: '#d97706',   // hover:bg-amber-600
                    },
                    text: '#f3f4f6',       // text-gray-100
                }
            },
        },
    },

    plugins: [forms],
};