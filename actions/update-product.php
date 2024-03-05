<?php
// Incluye el archivo de conexión a la base de datos
include("../connection/con.php");

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se han proporcionado todos los datos necesarios
    if (isset($_POST['product_name'], $_POST['product_code'], $_POST['quantity'], $_POST['price'], $_POST['people'], $_POST['nif_cif'])) {
        // Obtiene los datos del formulario
        $productID = $_POST['tbl_product_id'];
        $productName = $_POST['product_name'];
        $productCode = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        // Reemplazamos las , por . en el precio para guardarlo en la base de datos
        $price = str_replace(',', '.', $price);
        
        // Elimina el símbolo de moneda del precio
        $price = preg_replace('/[^0-9,.]/', '', $price);
        // Reemplaza las comas por puntos en el precio
        $price = str_replace(',', '.', $price);
        
        // Obtiene la fecha actual
        $date = date("Y-m-d H:i:s");
        
        // Obtiene los datos restantes del formulario
        $transaction = $_POST['transaction'];
        $people = $_POST['people'];
        $nif_cif = $_POST['nif_cif'];
        $notes = $_POST['notes'];

        try {
            // Prepara la consulta para actualizar el registro en la base de datos
            $stmt = $conn->prepare("UPDATE tbl_product 
            SET product_name = :product_name, product_code = :product_code, quantity = :quantity, price = :price, date = :date, transaction = :transaction, people = :people, nif_cif = :nif_cif, notes = :notes 
            WHERE tbl_product_id = :tbl_product_id");

            // Enlaza los parámetros de la consulta
            $stmt->bindParam(":tbl_product_id", $productID, PDO::PARAM_INT);
            $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
            $stmt->bindParam(":product_code", $productCode, PDO::PARAM_STR);
            $stmt->bindParam(":quantity", $quantity, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            $stmt->bindParam(":date", $date, PDO::PARAM_STR);
            $stmt->bindParam(":transaction", $transaction, PDO::PARAM_STR);
            $stmt->bindParam(":people", $people, PDO::PARAM_STR);
            $stmt->bindParam(":nif_cif", $nif_cif, PDO::PARAM_STR);
            $stmt->bindParam(":notes", $notes, PDO::PARAM_STR);

            // Ejecuta la consulta
            $stmt->execute();

            // Redirige de vuelta al index con un mensaje de éxito
            redirectToIndex("Registro actualizado correctamente!!!");

        } catch (PDOException $e) {
            // En caso de error, muestra un mensaje de error
            $errorMessage = "Error al actualizar el registro: " . $e->getMessage();
            redirectToIndex($errorMessage);
        }
    } else {
        // Si no se proporcionan todos los datos, muestra un mensaje de error
        redirectToIndex("Debes rellenar todas las casillas!!!");
    }
}

// Función para redirigir de vuelta al index con un mensaje
function redirectToIndex($message) {
    echo "<script>
            alert('$message');
            window.location.href = 'http://localhost/inventario-excel/';
          </script>";
    exit();
}