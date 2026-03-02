/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
                heading: ['"DM Sans"', 'system-ui', 'sans-serif'],
            },
            colors: {
                brand: {
                    DEFAULT: '#4a6cf7',
                    dark: '#3b5de7',
                    light: '#e8edfe',
                },
                accent: {
                    DEFAULT: '#22c997',
                    dark: '#1ab080',
                    light: '#e6faf4',
                },
                surface: '#ffffff',
                muted: '#6b7b93',
            },
        },
    },
    plugins: [],
};
