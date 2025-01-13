// Define the fields available for filtering
const fields = [
    { value: "numero_registro", text: "Número de Registro" },
    { value: "classificacion_generica", text: "Clasificación Genérica" },
    { value: "nombre_objeto", text: "Nombre Objeto" },
    { value: "coleccion_procedencia", text: "Colección Procedencia" },
    { value: "maxima_altura", text: "Máxima Altura" },
    { value: "maxima_anchura", text: "Máxima Anchura" },
    { value: "maxima_profundidad", text: "Máxima Profundidad" },
    { value: "material", text: "Material" },
    { value: "tecnica", text: "Técnica" },
    { value: "autor", text: "Autor" },
    { value: "titulo", text: "Título" },
    { value: "ano_inicio", text: "Año Inicio" },
    { value: "ano_final", text: "Año Final" },
    { value: "datacion", text: "Datación" },
    { value: "ubicacion", text: "Ubicación" },
    { value: "fecha_registro", text: "Fecha Registro" },
    { value: "numero_ejemplares", text: "Número de Ejemplares" },
    { value: "forma_ingreso", text: "Forma Ingreso" },
    { value: "fecha_ingreso", text: "Fecha Ingreso" },
    { value: "fuente_ingreso", text: "Fuente Ingreso" },
    { value: "baja", text: "Baja" },
    { value: "causa_baja", text: "Causa Baja" },
    { value: "fecha_baja", text: "Fecha Baja" },
    { value: "persona_aut_baja", text: "Persona Autorizada Baja" },
    { value: "estado_conservacion", text: "Estado Conservación" },
    { value: "lugar_ejecucion", text: "Lugar Ejecución" },
    { value: "lugar_procedencia", text: "Lugar Procedencia" },
    { value: "num_tirada", text: "Número de Tirada" },
    { value: "otros_num_id", text: "Otros Números ID" },
    { value: "valoracion_econ", text: "Valoración Económica" },
    { value: "id_exposicion", text: "ID Exposición" },
    { value: "bibliografia", text: "Bibliografía" },
    { value: "descripcion", text: "Descripción" },
    { value: "historia_obra", text: "Historia de la Obra" }
];

// Define numeric and date fields
const numericFields = [
    "numero_registro", "maxima_altura", "maxima_anchura", "maxima_profundidad",
    "ano_inicio", "ano_final", "numero_ejemplares", "num_tirada",
    "valoracion_econ", "id_exposicion"
];
const dateFields = ["fecha_registro", "fecha_ingreso", "fecha_baja"];

// Define the relationships for foreign key fields
const foreignKeyFields = {
    "classificacion_generica": "Clasificación Genérica",
    "material": "Material",
    "tecnica": "Técnica",
    "autor": "Autor",
    "datacion": "Datación",
    "ubicacion": "Ubicación",
    "forma_ingreso": "Forma Ingreso",
    "id_exposicion": "Exposición",
    "estado_conservacion": "Estado de Conservación"
};
document.addEventListener("DOMContentLoaded", () => {
    const filterGroupsContainer = document.getElementById("filterGroups");
    const addFiltersButton = document.getElementById("addFiltersButton");
    const busquedaAvanzadaDiv = document.getElementById("busquedaAvanzada");

    let filtersAdded = false; // Controlar si los filtros ya fueron generados

    // Función para crear 5 filtros dinámicamente
    const generateFilters = () => {
        if (!filtersAdded) {
            for (let i = 1; i < 5; i++) {
                filterGroupsContainer.appendChild(createFilterGroup(i));
            }
            filtersAdded = true; // Marcar que los filtros ya se generaron
        }
    };

    // Evento para mostrar/ocultar los filtros
    addFiltersButton.addEventListener("click", () => {
        generateFilters(); // Generar los filtros solo si aún no se han generado
        busquedaAvanzadaDiv.classList.toggle("visible");
    });
});

// Función para crear un grupo de filtros
const createFilterGroup = (index) => {
    const group = document.createElement("div");
    group.classList.add("filter-group");

    const label = document.createElement("label");
    label.textContent = `Campo ${index + 1}:`;
    label.htmlFor = `filterField${index + 1}`;

    const select = document.createElement("select");
    select.name = `filterField${index + 1}`;
    select.id = `filterField${index + 1}`;
    select.innerHTML = '<option value="">Seleccione un campo</option>' + fields.map(field =>
        `<option value="${field.value}">${field.text}</option>`
    ).join("");

    const input = document.createElement("input");
    input.type = "text";
    input.name = `filterValue${index + 1}`;
    input.id = `filterValue${index + 1}`;
    input.placeholder = "Valor";

    group.appendChild(label);
    group.appendChild(select);
    group.appendChild(input);
    return group;
};

// Add filter groups to the page
// Update input type and placeholder dynamically based on selected field
document.getElementById("filterGroups").addEventListener("change", function (e) {
    if (e.target.tagName === "SELECT") {
        const index = e.target.id.replace("filterField", "");
        const input = document.getElementById(`filterValue${index}`);
        const fieldType = e.target.value;

        if (numericFields.includes(fieldType)) {
            input.placeholder = "Rango (ej, 10-50)";
            input.type = "text";
        } else if (dateFields.includes(fieldType)) {
            input.placeholder = "Fecha";
            input.type = "date";
        } else if (Object.keys(foreignKeyFields).includes(fieldType)) {
            input.placeholder = `Buscar por ${foreignKeyFields[fieldType]}`;
            input.type = "text";
        } else {
            input.placeholder = "Texto";
            input.type = "text";
        }
    }
});
const filterGroupsContainer = document.getElementById("filterGroups");
const addFiltersButton = document.getElementById("addFiltersButton");

let filterCount = 0; // Contador para rastrear cuántos filtros se han añadido

addFiltersButton.addEventListener("click", function () {
    if (filterCount < 5) { // Máximo 5 filtros
        filterGroupsContainer.appendChild(createFilterGroup(filterCount));
        filterCount++;
    } else {
        alert("Solo puedes añadir hasta 5 filtros.");
    }
});







