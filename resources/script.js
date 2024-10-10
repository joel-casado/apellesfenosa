const usernameInput = document.getElementById('username');
const usernameErrorSpan = document.getElementById('username-error');

// Verificar el nombre de usuario en tiempo real
usernameInput.addEventListener('input', async () => {
    const username = usernameInput.value.trim();
    if (username !== '') {
        try {
            const response = await fetch(`index.php?controller=Usuaris&action=checkUsername&username=${username}`);
            const data = await response.json();
            if (data.exists) {
                usernameErrorSpan.textContent = 'Nombre de usuario repetido';
                usernameErrorSpan.style.color = 'red';
            } else {
                usernameErrorSpan.textContent = ''; // Limpiar el mensaje si el usuario no existe
            }
        } catch (error) {
            console.error(error);
        }
    } else {
        usernameErrorSpan.textContent = ''; // Limpiar mensaje si el campo está vacío
    }
});

// Validar formulario antes de enviarlo
function validarFormulario() {
    // Verificar si hay un mensaje de error
    if (usernameErrorSpan.textContent !== '') {
        return false; // No enviar el formulario si hay un error
    }
    return true; // Permitir el envío del formulario si no hay errores
}
