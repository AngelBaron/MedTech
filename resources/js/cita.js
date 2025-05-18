import { Spanish } from "flatpickr/dist/l10n/es.js";
const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
const inicioPicker = flatpickr("#inicioFecha", {
    dateFormat: "Y-m-d",
    minDate: "today",
    locale: Spanish, // Usa el objeto de localización en español
    theme: prefersDark ? "dark" : "light",
    onChange: function (selectedDates, dateStr, instance) {
        // Cuando cambia la fecha de inicio, actualiza minDate del fin
        finPicker.set("minDate", dateStr);
    }
});


const finPicker = flatpickr("#finFecha", {
    dateFormat: "Y-m-d",
    minDate: "today",
    locale: Spanish, // Usa el objeto de localización en español
    theme: prefersDark ? "dark" : "light",

});


window.showTratamientoDiv = function () {
    console.log("showTratamientoDiv called");
    document.getElementById("tratamientoDiv").style.display = "block";

    //Hacer que los inputs de tratamiento sean obligatorios
    document.getElementById("diagnostico").setAttribute("required", "required");
    document.getElementById("indicaciones").setAttribute("required", "required");
    document.getElementById("inicioFecha").setAttribute("required", "required");
    document.getElementById("finFecha").setAttribute("required", "required");

}


window.hideTratamientoDiv = function () {
    document.getElementById("tratamientoDiv").style.display = "none";
    //Hacer que los inputs de tratamiento no sean obligatorios
    document.getElementById("diagnostico").removeAttribute("required");
    document.getElementById("indicaciones").removeAttribute("required");
    document.getElementById("inicioFecha").removeAttribute("required");
    document.getElementById("finFecha").removeAttribute("required");
}