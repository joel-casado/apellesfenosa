function search() {
    // Get the search input value
    let query = document.getElementById('q').value.toLowerCase();
    
    // Get all rows from the table body
    let tableRows = document.querySelectorAll('.table tbody tr');
    
    // Loop through the rows to check for matches
    tableRows.forEach(row => {
        // Get all cell data from the current row
        let cells = row.querySelectorAll('td');
        let match = false;

        // Loop through each cell to see if it matches the query
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(query)) {
                match = true; // Mark as a match if query is found
            }
        });

        // Show or hide the row based on the match result
        row.style.display = match ? '' : 'none';
    });
}
