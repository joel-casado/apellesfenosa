function agregarObras() {
    console.log("Función agregarObras llamada");

    // Obtiene el ID de la exposición del botón
    const button = document.querySelector('.btn-success');
    const id_exposicion = button.getAttribute('data-id-exposicion');

    // Obtiene los checkbox seleccionados
    const checkboxes = document.querySelectorAll('.checkbox-obra:checked');
    const obrasSeleccionadas = Array.from(checkboxes).map(cb => cb.value);

    if (obrasSeleccionadas.length === 0) {
        alert('Por favor, selecciona al menos una obra.');
        return;
    }

    // Envia los datos al controlador con Fetch y JSON
    fetch('index.php?controller=Exposiciones&action=anadirObrasSeleccionadas&id=' + id_exposicion, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ exposicion_ids: obrasSeleccionadas })
    })
    
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.success) {
            alert('Obras añadidas con éxito.');
            location.reload();
        } else {
            alert('Hubo un error al añadir las obras.');
        }
    })
}