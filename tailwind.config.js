import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class", // Habilitar el modo oscuro con la clase 'dark'

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            colors: {
                primary: "#ffb802", // Amarillo
                background: "#F2F2F2", // Fondo claro
                text: "#010440", // Azul oscuro
                secondary: "#1F2624", // Verde oscuro
                accent: "#4C5954", // Gris verdoso
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                custom: ["PT Sans Caption", "sans-serif"],
            },
        },
    },

    plugins: [forms, require("flowbite/plugin")],
};
