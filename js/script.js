$(document).ready(function() {
    $('.product-table').DataTable();
});

function updateProduct(id) {
    $("#updateProductModal").modal("show");

    let updateProductID = $("#productID-" + id).text();
    let updateClient = $("#people-" + id).text();
    let updateNif_Cif = $("#nif_cif-" + id).text();
    let updateTransaction = $("#transaction-" + id).text();
    let updateProductName = $("#productName-" + id).text();
    let updateProductCode = $("#productCode-" + id).text();
    let updateQuantity = $("#quantity-" + id).text();
    let updatePrice = $("#price-" + id).text();
    let updateNotes = $("#notes-" + id).text();
    console.log($("#notes-" + id).text())
    // Eliminar el símbolo € del precio
    updatePrice = updatePrice.replace('€', '');

    $("#updateProductID").val(updateProductID);
    $("#updateClient").val(updateClient);
    $("#updateNif_Cif").val(updateNif_Cif);
    $("#updateTransaction").val(updateTransaction);
    $("#updateProductName").val(updateProductName);
    $("#updateProductCode").val(updateProductCode);
    $("#updateQuantity").val(updateQuantity);
    $("#updatePrice").val(updatePrice);
    $("#updateNotes").val(updateNotes);
}


function deleteProduct(id) {
    if (confirm('Deseas eliminar este producto?')) {
        window.location.href = "./actions/delete-product.php?product=" + id;
    }
}


function exportToExcel() {
    // Get table data
    var table = $('.product-table').DataTable();
    var data = table.rows().data().toArray();

    // Remove the "Action" column from the data
    var filteredData = data.map(function(row) {
        return row.slice(0, row.length - 1);
    });

    // Create a worksheet
    var ws = XLSX.utils.aoa_to_sheet([
        ['ID', 'Nombre de Producto', 'Código', 'Cantidad', 'Precio', 'Fecha de actualización', 'Trasacción', 'Cliente', 'NIF/CIF', 'Notas']
    ].concat(filteredData));

    // Create a workbook
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'entreunosyceros.net');

    // Save the workbook as an Excel file
    XLSX.writeFile(wb, 'inventario-excel.xlsx');
}

