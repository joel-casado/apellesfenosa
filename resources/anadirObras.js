function agregarObras() {
    // Obtiene los checkbox seleccionados
    const checkboxes = document.querySelectorAll('.checkbox-obra:checked');
    const obrasSeleccionadas = Array.from(checkboxes).map(cb => cb.value);

    if (obrasSeleccionadas.length === 0) {
        alert('Por favor, selecciona al menos una obra.');
        return;
    }

    // Envia los datos al controlador con Fetch y JSON
    fetch('index.php?controller=Exposiciones&action=anadirObrasSeleccionadas', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ obras: obrasSeleccionadas })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Obras añadidas con éxito.');
            location.reload();
        } else {
            alert('Hubo un error al añadir las obras.');
        }
    })
    .catch(error => console.error('Error:', error));
}