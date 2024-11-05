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
    console.log("Datos del formulario a enviar:", ...formData.entries());

    fetch("index.php?controller=Obras&action=crear", {
        method: "POST",
        body: formData,
    })
    .then(response => {
        return response.text().then(text => {
            console.log("Respuesta del servidor:", text);
            if (!response.ok) {
                throw new Error("Error en la respuesta del servidor");
            }
            return JSON.parse(text);
        });
    })
    .then(data => {
        console.log("Datos recibidos en formato JSON:", data);
        if (data.success) {
            alert(data.message);
            // Redireccionar o actualizar la vista
        } else if (data.errors) {
            alert("Errores: " + data.errors.join(", "));
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error("Error al procesar la solicitud:", error);
        alert("Hubo un error en la solicitud.");
    });
});
