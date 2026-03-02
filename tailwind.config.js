import defaultTheme from 'tailwindcss/defaultTheme'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['DM Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    DEFAULT: '#4a6cf7',
                    dark: '#3b5de7',
                    light: '#eef0fe',
                },
                accent: {
                    DEFAULT: '#22c997',
                    light: '#e6faf5',
                    dark: '#179e77',
                },
                surface: '#ffffff',
                muted: '#6b7b93',
            },
        },
    },
    plugins: [],
}