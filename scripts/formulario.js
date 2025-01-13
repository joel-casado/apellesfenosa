function toggleSection(titleElement) {
    const content = titleElement.nextElementSibling; // Selecciona el siguiente elemento (contenido)
    const arrow = titleElement.querySelector('.arrow'); // Selecciona la flecha dentro del título

    console.log('Se ha hecho clic en:', titleElement);
    console.log('Estado inicial del contenido:', content.style.display);

    // Cambia la visibilidad del contenido
    if (content.style.display === "block") {
        content.style.display = "none";
        arrow.textContent = "▼"; // Flecha hacia abajo
        console.log('Contenido oculto');
    } else {
        content.style.display = "block";
        arrow.textContent = "▲"; // Flecha hacia arriba
        console.log('Contenido mostrado');
    }
}


document.querySelectorAll('input[type="text"]').forEach(input => {
    input.addEventListener('input', () => {
        // Transforma la primera letra de cada palabra en mayúscula
        input.value = input.value.replace(/\b\w/g, char => char.toUpperCase());
    });
});

// Obtén los selectores
const datacionSelect = document.getElementById('datacion');
const anoInicioSelect = document.getElementById('ano_inicio');
const anoFinalSelect = document.getElementById('ano_final');

// Escucha el evento de cambio en el selector de datación
datacionSelect.addEventListener('change', function () {
    // Obtén la opción seleccionada
    const selectedOption = datacionSelect.options[datacionSelect.selectedIndex];

    // Extrae los valores de data-ano-inicio y data-ano-final
    const anoInicio = selectedOption.getAttribute('data-ano-inicio');
    const anoFinal = selectedOption.getAttribute('data-ano-final');

    // Actualiza los selectores de Año Inicio y Año Final
    if (anoInicio && anoFinal) {
        anoInicioSelect.value = anoInicio;
        anoFinalSelect.value = anoFinal;
    }
});


document.getElementById("crearObraForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const requiredFields = ['n_registro', 'titulo'];
    for (let field of requiredFields) {
        const input = document.getElementById(field);
        if (input && input.style.display === 'none') {
            input.closest('.section-content').style.display = 'block'; // Muestra la sección
        }
    }
    
    console.log('Formulario enviado, validando campos...');

    let isValid = true;

    // Temporarily show the required fields before validation
    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        const container = field.closest('.toggleable-section');
        if (container) {
            container.style.display = "block"; // Show the section temporarily
        }
    });

    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (!field.value) {
            isValid = false;
            field.style.borderColor = "red"; // Highlight the empty field
            console.warn(`El campo ${fieldId} está vacío.`);
        } else {
            field.style.borderColor = ""; // Remove the highlight
            console.log(`El campo ${fieldId} tiene valor:`, field.value);
        }
    });

    if (!isValid) {
        console.error("Hay campos requeridos vacíos.");
        alert("Por favor, completa todos los campos requeridos.");

        // Hide the sections again after showing the error
        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            const container = field.closest('.toggleable-section');
            if (container) {
                container.style.display = "none"; // Hide the section again
            }
        });

        return; // Stop submission if there are empty fields
    }

    const formData = new FormData(this);
    console.log('Datos del formulario preparados para enviar:', formData);

    fetch('index.php?controller=Obras&action=crear', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Estado de la respuesta:', response.status);
        return response.text();  // Cambiar a .text() para inspección
    })
    .then(data => {
        console.log('Respuesta del servidor (raw):', data);  // Inspecciona si contiene HTML o JSON
        if (data.trim() === "") {
            console.error('La respuesta está vacía.');
            alert("La respuesta del servidor está vacía.");
            return;
        }
        try {
            data = JSON.parse(data);  // Intenta parsear JSON
            console.log('Respuesta del servidor (JSON parseado):', data);
            if (data.success) {
                alert(data.message);  // Muestra mensaje de éxito
                if (data.redirect) {
                    console.log('Redirigiendo a:', data.redirect);
                    window.location.href = data.redirect;  // Redirige al usuario
                }
            } else {
                alert(data.message);  // Muestra mensaje de error
                return;
            }
        } catch (error) {
            console.error('Error al parsear JSON:', error);
            alert("Error en la respuesta del servidor.");
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));    
});
