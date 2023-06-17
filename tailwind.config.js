/** @type {import('tailwindcss').Config} */
module.exports = {
  purge: {
    enabled: production,
    content: [
      './resources/views/**/*.blade.php',
      // Agrega aquí otras rutas de archivos de plantilla Blade si es necesario.
    ],
  },
  content: [
    './resources/views/**/*.blade.php',
    // Agrega aquí otras rutas de archivos de plantilla Blade si es necesario.
  ],
  darkMode: false,
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
};