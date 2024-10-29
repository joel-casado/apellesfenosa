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






document.getElementById('crearObraForm').addEventListener('submit', function(e) {
e.preventDefault();  // Evitar recarga de la página

    // Recoger los datos del formulario
    let formData = new FormData(this);
    
    // Enviar los datos al servidor con fetch
    fetch('index.php?controller=Obras&action=crear', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const resultadoDiv = document.getElementById('crearResponseMessage');
        if (data.success) {
            resultadoDiv.innerHTML = `<p>${data.message}</p>`;
        } else {
            resultadoDiv.innerHTML = `<p>Error: ${data.message}</p>`;
            if (data.errors) {
                data.errors.forEach(error => {
                    resultadoDiv.innerHTML += `<p>${error}</p>`;
                });
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});