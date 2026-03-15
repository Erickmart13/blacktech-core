import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
export default {
    presets: [

        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
    ],
    content: [
        './app/Livewire/**/*Table.php',
        './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
        './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/PowerGridThemes/**/*.php',
    ],

    safelist: [

        'bg-sky-500',
        'bg-orange-500',
        'bg-green-700',

    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "pg-primary": colors.slate
            }
        },
    },

    plugins: [
        forms, typography,
        require('@tailwindcss/forms')
    ],
};
