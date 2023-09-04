import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                purple: {
                    200: "#8683ef",
                    300: "#6865EF",
                    400: "#5F5CE6",
                    500: "#4F4CEB",
                },
                "white-purple": "#F1F1FB",
            },
        },
    },

    plugins: [forms, require("daisyui")],
};
