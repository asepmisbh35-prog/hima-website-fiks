import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
   
    darkMode: 'class',

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.blade.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
         
            keyframes: {
                fadeUp: {
                    from: { opacity: '0', transform: 'translateY(24px)' },
                    to:   { opacity: '1', transform: 'translateY(0)' },
                },
                scrollDown: {
                    '0%':   { transform: 'scaleY(0)', transformOrigin: 'top' },
                    '50%':  { transform: 'scaleY(1)', transformOrigin: 'top' },
                    '51%':  { transform: 'scaleY(1)', transformOrigin: 'bottom' },
                    '100%': { transform: 'scaleY(0)', transformOrigin: 'bottom' },
                },
                fadeIn: {
                    from: { opacity: '0' },
                    to:   { opacity: '1' },
                },
                slideUp: {
                    from: { transform: 'translateY(30px)', opacity: '0' },
                    to:   { transform: 'translateY(0)',     opacity: '1' },
                },
            },
            
            
            animation: {
                'fade-up-03': 'fadeUp 0.8s 0.3s forwards',
                'fade-up-05': 'fadeUp 0.8s 0.5s forwards',
                'fade-up-07': 'fadeUp 0.8s 0.7s forwards',
                'fade-up-09': 'fadeUp 0.8s 0.9s forwards',
                'fade-up-12': 'fadeUp 0.8s 1.2s forwards',
                'scroll-down': 'scrollDown 1.5s ease infinite',
                'slide-up':    'slideUp 0.3s ease',
                'fade-up':     'fadeUp 0.6s ease forwards',
                'fade-in':     'fadeIn 0.4s ease forwards',
            },

            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            
            colors: {
                primary: {
                    50: '#fff7ed', // Typo ###fff7ed sudah diperbaiki
                    100: '#ffedd5',
                    200: '#fed7aa',
                    300: '#fdba74',
                    400: '#fb923c',
                    500: '#f97316',
                    600: '#ea580c',
                    700: '#c2410c',
                    800: '#9a3412',
                    900: '#7c2d12',
                    950: '#431407',
                },
                secondary: {
                    50:'#FF5C00',
                    100:'#FFA500'
                }
            },
        },
    },
    plugins: [forms],
};