/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
        // You will probably also need those lines
        "./resources/**/**/*.{js,blade.php}",
        "./app/View/Components/**/**/*.php",
        "./app/Livewire/**/**/*.php",
    
        // Add mary
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",

        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',

  ],
  theme: {
    extend: {},
  },
  daisyui: {
    themes: [
      "nord",
    ],
  },
  plugins: [require("daisyui")],
}

