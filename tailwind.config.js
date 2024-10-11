/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    screens: {
      'phone': '640px',
      // => @media (min-width: 640px) { ... }

      'tablet': '900px',

      'desktop': '1280px',
      // => @media (min-width: 1280px) { ... }
    },
    extend: {
      colors: {
        primary: "#E50914",
        secondary: "#B20710",
        navbar_background: "#161616",
      }
    },
  },
  plugins: [
    require('tailwind-scrollbar')({ nocompatible: true }),
  ],
  
}

