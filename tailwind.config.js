const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                sky: colors.sky,
                teal: colors.teal,
                cyan: colors.cyan,
                rose: colors.rose,
                'warm-gray': colors.stone,
                teal: colors.teal,
            }
        },
    },
    content: [
        './resources/**/*.{html,js,jsx,ts,tsx,vue,twig}',
        './resources/**/*.blade.php',
        './vendor/livewire-ui/modal/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
    ],
    // safelist: [
    //     'sm:max-w-2xl',
    //     'sm:max-w-sm',
    //     'hidden',
    //     'break-words'
    // ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
