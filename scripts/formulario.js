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

    // Validar campos requeridos
    let isValid = true;
    const requiredFields = [ /* [tus campos] */ ];

    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (!field.value) {
            isValid = false;
            field.style.borderColor = "red"; // Resalta el campo
            console.warn(`El campo ${fieldId} está vacío.`); // Log de advertencia
        } else {
            field.style.borderColor = ""; // Quita el resaltado
        }
    });

    if (!isValid) {
        console.error("Hay campos requeridos vacíos."); // Log de error
        alert("Por favor, completa todos los campos requeridos.");
        return; // Detener el envío si hay campos vacíos
    }

    const formData = new FormData(this);
    console.log("Datos del formulario a enviar:", ...formData.entries());

    console.log('Forma de Ingreso:', document.getElementById('forma_ingreso').value);

    fetch("index.php?controller=Obras&action=crear", {
        method: "POST",
        body: formData,
    })
    .then(response => {
        console.log("Respuesta del servidor recibida."); // Log de respuesta
        if (response.headers.get("content-type").includes("application/json")) {
            return response.json();
        } else {
            return response.text().then(text => {
                console.error("Respuesta inesperada del servidor: " + text); // Log de error
                throw new Error("Respuesta inesperada del servidor: " + text);
            });
        }
    })
    .then(data => {
        console.log("Datos recibidos en formato JSON:", data);
        if (data.success) {
            alert(data.message);
            console.log("Redirigiendo a:", data.redirect); // Log de redirección
            window.location.href = data.redirect;
        } else if (data.errors) {
            alert("Errores: " + data.errors.join(", "));
            console.error("Errores devueltos:", data.errors); // Log de errores
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error("Error al procesar la solicitud:", error);
        alert("Hubo un error en la solicitud: " + error.message);
    });
});


