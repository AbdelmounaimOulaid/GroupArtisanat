/** @type {import('tailwindcss').Config} */
export default {
  content: [  
    "./node_modules/flowbite/**/*.js",  
      "./resources/**/*.blade.php",
      "./resources/views/filament/resources/order-resources/**/*.blade.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}