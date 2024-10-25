document.getElementById('crearObraForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    let formData = new FormData(this);
    let valid = validateForm(); // Run client-side validation

    if (!valid) {
        document.getElementById('crearResponseMessage').innerText = 'Por favor, corrige los errores antes de enviar.';
        return; // Stop form submission if validation fails
    }

    fetch('../../index.php?controller=Obras&action=crear', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Registrar el contenido que está devolviendo el servidor
        return response.text().then(text => {
            console.log("Respuesta del servidor:", text);
            try {
                return JSON.parse(text); // Intentar parsear el JSON
            } catch (e) {
                throw new Error('Respuesta no válida del servidor: ' + text);
            }
        });
    })
    .then(data => {
        if (data.success) {
            document.getElementById('crearResponseMessage').innerText = 'Obra creada con éxito';
        } else {
            document.getElementById('crearResponseMessage').innerText = 'Error al crear la obra: ' + data.message;
        }
    })
    .catch(error => {
        document.getElementById('crearResponseMessage').innerText = 'Ocurrió un error al crear la obra: ' + error.message;
        console.error('Error:', error);
    });
    
});

function validateForm() {
    let isValid = true;

    // Example of client-side validation
    let titulo = document.getElementById('titulo').value;
    if (titulo === '') {
        isValid = false;
        document.getElementById('tituloError').innerText = 'El título es obligatorio';
    } else {
        document.getElementById('tituloError').innerText = '';
    }

    let n_registro = document.getElementById('n_registro').value;
    if (n_registro === '') {
        isValid = false;
        document.getElementById('nRegistroError').innerText = 'El Nº de registro es obligatorio';
    } else {
        document.getElementById('nRegistroError').innerText = '';
    }

    // Validate image file
    isValid = validarImagen() && isValid;

    // Add similar checks for other fields
    return isValid;
}

// Variables para validación de la imagen
const oneMegaBytesInBytes = 10 ** 6;
const pesoLimite = oneMegaBytesInBytes * 2; // 2 megabyte
const extensionesPermitidas =  ['jpg','jpeg','png'];
const miInput = document.querySelector('#foto');

function validarImagen () {
    // Resetea mensaje
    miInput.setCustomValidity('');

    // Si no hay archivo seleccionado, omitir la validación
    if (!miInput.files || miInput.files.length === 0) {
        return true; // No es obligatorio subir una imagen
    }

    // Destructuramos para obtener el nombre y el tamaño
    const { name: archivoNombre, size: archivoPeso } = miInput.files[0];

    // Obtenemos la extensión
    const fileExtension = archivoNombre.split(".").pop().toLowerCase();

    // Validamos si tiene una extensión válida
    if (!extensionesPermitidas.includes(fileExtension)){
        miInput.setCustomValidity('Formato no válido, solo se admite jpg y png');
    }

    // Validamos el peso
    if(archivoPeso > pesoLimite) {
        miInput.setCustomValidity('Archivo demasiado grande, máximo 2MB.');
    }

    // Mostrar el mensaje de error si existe
    if (!miInput.checkValidity()) {
        miInput.reportValidity();
        return false; // Invalid image
    }

    return true; // Valid image
}

miInput.addEventListener("input", validarImagen);
