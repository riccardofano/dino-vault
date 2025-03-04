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
            gridTemplateColumns: {
                "auto-fit-200": "repeat(auto-fit, minmax(200px, 1fr))",
            },
        },
        variants: {
            rendering: {
                auto: { imageRendering: "auto" },
                "crisp-edges": { imageRendering: "crisp-edges" },
                pixelated: { imageRendering: "pixelated" },
            },
        },
    },

    plugins: [forms],
};
