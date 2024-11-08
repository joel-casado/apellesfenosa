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

    fetch('index.php?controller=Obras&action=crear', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Cambia temporalmente a .text() para inspeccionar
    .then(data => {
        console.log('Respuesta del servidor:', data);  // Verifica si contiene HTML o JSON
        if (data.success) {
            alert(data.message);  // Muestra un mensaje de éxito
            if (data.redirect) {
                window.location.href = data.redirect;  // Redirige al usuario
            }
        } else {
            alert(data.message);  // Muestra un mensaje de error si la creación falla
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));    
});

