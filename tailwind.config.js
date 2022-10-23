module.exports = {
    content: [
        './templates/**/*.html.twig',
        './assets/**/*.{js,jsx,ts,tsx,vue}',
        './assets/**/*.scss'
    ],
    theme: {
        extend: {
            maxWidth: {
                '10xl': '130rem',
            }
        },
    },
    plugins: [
        require("@tailwindcss/forms")({
            strategy: 'class',
        }),
    ],
}
