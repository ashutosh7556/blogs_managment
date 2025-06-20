 import defaultTheme from 'tailwindcss/defaultTheme'
 import forms from '@tailwindcss/forms'

 /** @type {import('tailwindcss').Config} */
 export default {
   content: [
     // ✧ Laravel Framework's default Blade templates
     './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',

     // ✧ Compiled temporary views
     './storage/framework/views/*.php',

     // ✧ Your application views
     './resources/views/**/*.blade.php',

     // ✧ Livewire Tables package views
     './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',

     // ✧ Your published Livewire Tables overrides
     './resources/views/vendor/livewire-tables/**/*.blade.php',
   ],

   theme: {
     extend: {
       fontFamily: {
         sans: ['Figtree', ...defaultTheme.fontFamily.sans],
       },
     },
   },

   plugins: [forms],
 }
