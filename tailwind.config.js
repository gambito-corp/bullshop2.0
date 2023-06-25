/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            textStyles: {
                'Test': {
                'font-size': '3rem',
                'font-weight': 'bold',
                'text-decoration': 'underline',
                },
            },
        },
    },
    plugins: [],
}
