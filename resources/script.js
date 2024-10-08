const usernameInput = document.getElementById('username');
const usernameErrorSpan = document.getElementById('username-error');

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
        usernameErrorSpan.textContent = '';
    }
    } catch (error) {
    console.error(error);
    }
}
});
function validarFormulario() {
    // código para mostrar el mensaje de error
    document.getElementById("username-error").innerHTML = "Error: el nombre de usuario ya existe";
    return false;
}