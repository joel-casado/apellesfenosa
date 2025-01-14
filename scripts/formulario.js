function toggleSection(titleElement) {
    const content = titleElement.nextElementSibling; // Selecciona el siguiente elemento (contenido)
    const arrow = titleElement.querySelector('.arrow'); // Selecciona la flecha dentro del título

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

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('sugerirNumeroRegistro').addEventListener('click', function () {
        const letra = document.getElementById('letra').value.trim();

        if (!letra) {
            alert("Por favor, introduce una letra.");
            return;
        }

        console.log("Enviando letra al servidor:", letra);

        fetch('models/NumeroRegistro.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ letra }),
        })
            .then(response => {
                console.log("Respuesta del servidor:", response);
                return response.json();
            })
            .then(data => {
                console.log("Datos recibidos del servidor:", data);

                if (data.numero_registro_recomendado) {
                    // Separar el número de registro recomendado en sus componentes
                    const numeroRegistro = data.numero_registro_recomendado;
                    const letra = numeroRegistro.substring(0, 1); // Obtener la letra
                    const numero = numeroRegistro.substring(1, 5); // Obtener el número (4 dígitos)
                    const decimal = numeroRegistro.substring(6, 8); // Obtener los decimales (2 dígitos)

                    // Actualizar los campos del formulario
                    document.getElementById('letra').value = letra;
                    document.getElementById('n_registro').value = numero;
                    document.getElementById('decimales').value = decimal;

                    console.log("Número de registro recomendado actualizado:", numeroRegistro);
                } else {
                    console.warn("No se recibió un número de registro recomendado válido.");
                    alert("No se pudo obtener un número de registro recomendado.");
                }
            })
            .catch(error => {
                console.error('Error al obtener el número de registro:', error);
                alert("Hubo un error al obtener el número de registro. Por favor, inténtalo de nuevo.");
            });
    });
});



document.getElementById("crearObraForm").addEventListener("submit", function(event) {
    event.preventDefault();

    
    const valoracionEcon = document.getElementById('valoracion_econ').value;

    
    const regex = /^\d+(\.\d{1,2})?$/;

    if (valoracionEcon && !regex.test(valoracionEcon)) {
        alert('La valoración económica debe ser un número válido (ejemplo: 100.50).');
        document.getElementById('valoracion_econ').style.borderColor = "red"; // Resalta el campo
        return false;
    } else {
        document.getElementById('valoracion_econ').style.borderColor = ""; // Quita el resaltado
    }

    const fechaRegistro = document.getElementById('fecha_registro').value;
    const fechaIngreso = document.getElementById('fecha_ingreso').value;

    if (fechaIngreso && fechaRegistro && new Date(fechaIngreso) < new Date(fechaRegistro)) {
        alert('La fecha de ingreso no puede ser anterior a la fecha de registro.');
        return false;
    }

    const maximaAltura = document.getElementById('maxima_altura').value;
    const maximaAnchura = document.getElementById('maxima_anchura').value;
    const maximaProfundidad = document.getElementById('maxima_profundidad').value;
    const numeroEjemplares = document.getElementById('numero_ejemplares').value;

    if (maximaAltura && isNaN(maximaAltura)) {
        alert('La máxima altura debe ser un número.');
        return false;
    }

    if (maximaAnchura && isNaN(maximaAnchura)) {
        alert('La máxima anchura debe ser un número.');
        return false;
    }
    if (maximaProfundidad && isNaN(maximaProfundidad)) {
        alert('La máxima profundidad debe ser un número.');
        return false;
    }

    if (numeroEjemplares && isNaN(numeroEjemplares)) {
        alert('El número de ejemplares debe ser un número.');
        return false;
    }
    console.log('Formulario enviado, validando campos...');

    // Validar campos requeridos
    let isValid = true;
    const requiredFields = [ /* [tus campos] */ ];

    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (!field.value) {
            isValid = false;
            field.style.borderColor = "red"; // Resalta el campo
            console.warn(`El campo ${fieldId} está vacío.`);
        } else {
            field.style.borderColor = ""; // Quita el resaltado
            console.log(`El campo ${fieldId} tiene valor:`, field.value);
        }
    });

    if (!isValid) {
        console.error("Hay campos requeridos vacíos.");
        alert("Por favor, completa todos los campos requeridos.");
        return; // Detener el envío si hay campos vacíos
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
            }
        } catch (error) {
            console.error('Error al parsear JSON:', error);
            alert("Error en la respuesta del servidor.");
        }
    })
    
    .catch(error => console.error('Error en la solicitud:', error));    
});
