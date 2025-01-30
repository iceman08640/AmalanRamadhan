import "flowbite";
import "./bootstrap";
import Alpine from "alpinejs";

// Inisialisasi Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Tambahkan event listener untuk toggle dark mode
if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}
