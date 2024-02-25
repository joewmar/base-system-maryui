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
    // themes: [
    //   "light",
    //   {
    //     mytheme: {
    //       "primary": "#374151",
    //       "secondary": "#9ca3af",
    //       "accent": "#00c79c",
    //       "neutral": "#1c1917",
    //       "base-100": "#f3f4f6",
    //       "info": "#3b82f6",
    //       "success": "#84cc16",
    //       "warning": "#f59e0b",
    //       "error": "#e11d48",
    //     },
    //   },
    // ],
    
    themes: ["light", "corporate"],

  },
  plugins: [require("daisyui")],
}

