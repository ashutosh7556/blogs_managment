 // tailwind.config.js
 import defaultTheme from 'tailwindcss/defaultTheme'
 import forms from '@tailwindcss/forms'

 /** @type {import('tailwindcss').Config} */
 export default {
   content: [
     './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
     './storage/framework/views/*.php',
     './resources/views/**/*.blade.php',
     './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
     './resources/views/vendor/livewire-tables/**/*.blade.php',
   ],

   theme: {
     extend: {
       fontFamily: {
         sans: ['Figtree', ...defaultTheme.fontFamily.sans],
       },
       animation: {
         text: 'textPulse 3s ease-in-out infinite',
       },
       keyframes: {
         textPulse: {
           '0%, 100%': { opacity: 1 },
           '50%': { opacity: 0.6 },
         },
       },
     },
   },

   plugins: [forms],
 }
