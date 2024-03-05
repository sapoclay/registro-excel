<?php
include("../connection/con.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar que todos los campos requeridos estén presentes y no estén vacíos
    $requiredFields = ['product_name', 'product_code', 'quantity', 'price', 'transaction', 'people', 'nif_cif'];
    $missingFields = array_filter($requiredFields, function($field) {
        return !isset($_POST[$field]) || empty($_POST[$field]);
    });

    if (!empty($missingFields)) {
        // Mostrar mensaje de error si faltan campos requeridos
        $errorMessage = "Por favor, complete todos los campos.";
        redirectToIndex($errorMessage);
    }

    // Validar datos numéricos
    $numericFields = ['quantity', 'price'];
    $invalidNumericFields = array_filter($numericFields, function($field) {
        return !is_numeric($_POST[$field]);
    });

    if (!empty($invalidNumericFields)) {
        // Mostrar mensaje de error si hay campos numéricos no válidos
        $errorMessage = "La cantidad y el precio deben ser números válidos.";
        redirectToIndex($errorMessage);
    }

    // Procesar los datos insertados
    try {
        $productName = $_POST['product_name'];
        $productCode = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        // Reemplazamos las , por . en el precio para guardarlo en la base de datos
        $price = str_replace(',', '.', $price);
        $date = date("Y-m-d H:i:s");
        $transaction = $_POST['transaction'];
        $people = $_POST['people'];
        $nif_cif = $_POST['nif_cif'];
        $notes = isset($_POST['notes']) ? $_POST['notes'] : '';

        // Insertar datos en la base de datos
        $stmt = $conn->prepare("INSERT INTO tbl_product (product_name, product_code, quantity, price, date, transaction, people, nif_cif, notes) 
            VALUES (:product_name, :product_code, :quantity, :price, :date, :transaction, :people, :nif_cif, :notes)");

        $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
        $stmt->bindParam(":product_code", $productCode, PDO::PARAM_STR);
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, PDO::PARAM_STR);
        $stmt->bindParam(":date", $date, PDO::PARAM_STR);
        $stmt->bindParam(":transaction", $transaction, PDO::PARAM_STR);
        $stmt->bindParam(":people", $people, PDO::PARAM_STR);
        $stmt->bindParam(":nif_cif", $nif_cif, PDO::PARAM_STR);
        $stmt->bindParam(":notes", $notes, PDO::PARAM_STR);

        $stmt->execute();

        // Redirigir con mensaje de éxito
        $successMessage = "Registro añadido correctamente.";
        redirectToIndex($successMessage);
    } catch (PDOException $e) {
        // Mostrar mensaje de error en caso de excepción
        $errorMessage = "Error al insertar el registro: " . $e->getMessage();
        redirectToIndex($errorMessage);
    } finally {
        // Cerrar la conexión a la base de datos
        $conn = null;
    }
} else {
    // Si no es una solicitud POST, redirigir con mensaje de error
    $errorMessage = "Acceso no permitido.";
    redirectToIndex($errorMessage);
}

function redirectToIndex($message) {
    echo "<script>
            alert('$message');
            window.location.href = 'http://localhost/inventario-excel/';
          </script>";
    exit();
}
?>
