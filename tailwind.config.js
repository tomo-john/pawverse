import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/livewire/flux/stubs/**/*.blade.php',
    ],

    safelist: [
        /* サイズ */
        {
            pattern: /text-(xl|[2-9]xl)/,
        },

        /* 色 */
        {
            pattern: /text-(white|black|gray|brown|gold|yellow|amber|pink|violet)-(50|100|200|300|400|500|600|700|800)/,
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
