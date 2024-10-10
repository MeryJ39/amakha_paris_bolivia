/** @type {import('tailwindcss').Config} */
export default {
    content: [
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
                sans: ["TT Firs Neue", "sans-serif"],
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
