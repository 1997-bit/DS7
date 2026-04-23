document.addEventListener("DOMContentLoaded", function() {
    const formulario = document.getElementById("formLibro");

    formulario.addEventListener("submit", function(evento) {
        let nombre = document.getElementById("nombre").value.trim();
        let autor = document.getElementById("autor").value.trim();
        let anio = document.getElementById("anio").value;
        let anioActual = new Date().getFullYear();

        // Validación para los campos vacíos
        if (nombre === "" || autor === "") {
            alert("Por favor, complete todos los campos de texto.");
            evento.preventDefault(); // Detiene el envío del formulario
            return;
        }

        // Validación lógica par el año
        if (anio < 1000 || anio > anioActual + 1) {
            alert("Por favor, ingrese un año de publicación válido.");
            evento.preventDefault();
            return;
        }

        // Confirmación visual para el usuario
        if (!confirm("¿Está seguro de que desea guardar estos cambios?")) {
            evento.preventDefault();
        }
    });
});