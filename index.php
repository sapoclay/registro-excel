<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro en Excel con PHP y MySQL</title>

    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <!--  Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<body>

    <div class="main">
        <div class="header alert alert-dark" role="alert">Transacciones en Excel con PHP y MyQL</div>

        <div class="product-container">

            <div class="product-header mb-2">
                <h3>Lista de transacciones</h3>

                <div class="button-group ml-auto">
                    <button type="button" class="btn btn-success" onclick="exportToExcel()">Exportar a Excel</button>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addProductModal">Añadir transacción</button>
                </div>
            </div>

            <!-- Modal para añadir la transacción -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProduct" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content mt-5">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProduct">Añadir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./actions/add-product.php" method="POST">
                                <div class="form-group">
                                    <label for="Client">Nombre de Cliente*:</label>
                                    <input type="text" class="form-control" id="Client" name="people" required>
                                </div>
                                <div class="form-group">
                                    <label for="Nif_Cif">NIF/CIF*:</label>
                                    <input type="text" class="form-control" id="Nif_Cif" name="nif_cif" required>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction">Transacción:</label>
                                    <select class="form-control" id="Transaction" name="transaction">
                                        <option value="compra">Compra</option>
                                        <option value="venta" selected>Venta</option>
                                    </select>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label for="productName">Nombre de Producto*:</label>
                                    <input type="text" class="form-control" id="productName" name="product_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="productCode">Código de Producto*:</label>
                                    <input type="text" class="form-control" id="productCode" name="product_code" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="quantity">Cantidad*:</label>
                                            <input type="text" class="form-control" id="quantity" name="quantity" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="price">Precio*:</label>
                                            <input type="text" class="form-control" id="price" name="price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notas:</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="4"></textarea>
                                </div>
                                <div class="aclaration form-group">
                                    <span id="aclaracion">Los campos con * son obligatorios</span>
                                </div>
                                <button type="submit" class="btn btn-primary form-control mt-1 mb-1">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para actualizar la transacción -->
            <div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProduct" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content mt-5">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateProduct">Actualizar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./actions/update-product.php" method="POST">
                                <div class="form-group" hidden>
                                    <label for="updateProductID">ID de Producto</label>
                                    <input type="text" class="form-control" id="updateProductID" name="tbl_product_id">
                                </div>
                                <div class="form-group">
                                    <label for="updateClient">Nombre de cliente*:</label>
                                    <input type="text" class="form-control" id="updateClient" name="people" required>
                                </div>
                                <div class="form-group">
                                    <label for="updateNif_Cif">NIF/CIF*:</label>
                                    <input type="text" class="form-control" id="updateNif_Cif" name="nif_cif" required>
                                </div>
                                <div class="form-group">
                                    <label for="updateTransaction">Transacción:</label>
                                    <input type="text" class="form-control" id="updateTransaction" name="transaction" readonly>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label for="updateProductName">Nombre de Producto*:</label>
                                    <input type="text" class="form-control" id="updateProductName" name="product_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="updateProductCode">Código de Producto*:</label>
                                    <input type="text" class="form-control" id="updateProductCode" name="product_code" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="updateQuantity">Cantidad*:</label>
                                            <input type="text" class="form-control" id="updateQuantity" name="quantity" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="updatePrice">Precio (€)*:</label>
                                            <input type="text" class="form-control" id="updatePrice" name="price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateNotes">Notas:</label>
                                    <textarea class="form-control" id="updateNotes" name="notes" rows="4"></textarea>
                                </div>
                                <div class="aclaration form-group">
                                    <span id="aclaracion">Los campos con * son obligatorios</span>
                                </div>
                                <button type="submit" class="btn btn-primary form-control mt-1 mb-1">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-hover product-table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Código</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Transacción</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">NIF/CIF</th>
                        <th scope="col" style="display: none;">Nota</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include('./connection/con.php');

                    $stmt = $conn->prepare("SELECT * FROM tbl_product");
                    $stmt->execute();

                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        $productID = $row['tbl_product_id'];
                        $productName = $row['product_name'];
                        $productCode = $row['product_code'];
                        $quantity = $row['quantity'];
                        $quantityT = $quantity;
                        $quantity = number_format($quantity, 0, '.', '.');
                        $price = $row['price'];
                        $priceT = $price;
                        // Reemplazamos las , por . en el precio
                        $price = str_replace('.', ',', $price);
                        $date = $row['date'];
                        $timestamp = strtotime($date);
                        // Formatear la fecha según el formato deseado
                        $date = date("H:i, d-m-Y", $timestamp);
                        $transaction = $row['transaction'];
                        $people = $row['people'];
                        $nif_cif = $row['nif_cif'];
                        $notes = $row['notes'];
                        $total = $quantityT * $priceT;
                        // Formatear el total con comas y dos decimales
                        $totalFormatted = number_format($total, 2, ',', '.');
                    ?>

                        <tr>
                            <th scope="row" id="productID-<?= $productID ?>"><?= $productID ?></th>
                            <td id="productName-<?= $productID ?>"><?= $productName ?></td>
                            <td id="productCode-<?= $productID ?>"><?= $productCode ?></td>
                            <td id="quantity-<?= $productID ?>"><?= $quantity ?></td>
                            <td id="price-<?= $productID ?>"><?= str_replace('€', '', $price) ?> €</td>
                            <td id="total-<?= $productID ?>"><?= $totalFormatted ?></td>
                            <td id="date-<?= $productID ?>"><?= $date ?></td>
                            <td id="transaction-<?= $productID ?>"><?= $transaction ?></td>
                            <td id="people-<?= $productID ?>"><?= $people ?></td>
                            <td id="nif_cif-<?= $productID ?>"><?= $nif_cif ?></td>
                            <td id="notes-<?= $productID ?>" style="display: none;"><?= $notes ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" style="font-size: 12px;" onclick="updateProduct(<?= $productID ?>)">
                                    Editar</button>
                                <button type="button" class="btn btn-danger" style="font-size: 12px;" onclick="deleteProduct(<?= $productID ?>)">
                                    Eliminar</button>
                                <?php if (!empty($notes)) : ?>
                                    <button type="button" class="btn btn-info" style="font-size: 12px;" onclick="openNoteModal('<?= $productID ?>', '<?= $notes ?>')">
                                        Ver Nota
                                    </button>
                                <?php endif; ?>

                            </td>
                        </tr>

                    <?php
                    }

                    ?>

                </tbody>
            </table>

        </div>
    </div>

        <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <span class="text-muted">entreunosyceros.net</span>
        </div>
    </footer>

    <!-- Boostrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- Librería SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>


    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <!-- Funciones Jquery -->
    <script src="./js/script.js"></script>

    <!-- Javascript Notas -->
    <script>
        function openNoteModal(productID, note) {
            var options = {
                title: 'Nota de la transacción con ID: ' + productID,
                width: 400,
                height: 200,
                left: (window.innerWidth - 400) / 2,
                top: (window.innerHeight - 300) / 2,
                resizable: 'yes',
                scrollbars: 'no',
                status: 'no',
                toolbar: 'no',
                menubar: 'no'
            };

            var customAlert = window.open('', '', 'width=' + options.width + ', height=' + options.height + ', left=' + options.left + ', top=' + options.top + ', resizable=' + options.resizable + ', scrollbars=' + options.scrollbars + ', status=' + options.status + ', toolbar=' + options.toolbar + ', menubar=' + options.menubar);

            // html de la nota
            customAlert.document.write('<html><head><title>' + options.title + '</title></head><body style="background-color: #ffffcc;"><p><b>Nota de la transacción con ID ' + productID + ':</b> ' + note + '</p></body></html>');
        }
    </script>
</body>

</html>