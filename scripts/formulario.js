function toggleSection(titleElement) {
    const content = titleElement.nextElementSibling; // Selecciona el siguiente elemento (contenido)
    const arrow = titleElement.querySelector('.arrow'); // Selecciona la flecha dentro del título

    // Cambia la visibilidad del contenido
    if (content.style.display === "block") {
        content.style.display = "none";
        arrow.textContent = "▼"; // Flecha hacia abajo
    } else {
        content.style.display = "block";
        arrow.textContent = "▲"; // Flecha hacia arriba
    }
}


document.getElementById("crearObraForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("index.php?controller=Obras&action=crear", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message); // Mensaje de éxito
            // Redireccionar o actualizar la vista según sea necesario
        } else if (data.errors) {
            alert("Errores: " + data.errors.join(", ")); // Mostrar errores de validación
        } else {
            alert(data.message); // Mensaje de error general
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Hubo un error en la solicitud.");
    });
});