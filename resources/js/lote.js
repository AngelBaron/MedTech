import { Spanish } from "flatpickr/dist/l10n/es.js";
const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

flatpickr("#fechaLote", {
    dateFormat: "Y-m-d",
    minDate: "today",
    locale: Spanish, // Usa el objeto de localización en español
    theme: prefersDark ? "dark" : "light",

});