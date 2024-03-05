<?php
// Incluye el archivo de conexión a la base de datos
include("../connection/con.php");

// Verifica si se ha proporcionado un ID de producto a eliminar
if (isset($_GET['product'])) {
    // Obtiene el ID del producto de la URL
    $productID = $_GET['product'];

    try {
        // Prepara la consulta para eliminar el producto con el ID especificado
        $stmt = $conn->prepare("DELETE FROM tbl_product WHERE tbl_product_id = :tbl_product_id");
        
        // Enlaza el parámetro del ID del producto
        $stmt->bindParam(':tbl_product_id', $productID, PDO::PARAM_INT);
        
        // Ejecuta la consulta para eliminar el producto
        $stmt->execute();

        // Redirige de vuelta al index con un mensaje de éxito
        redirectToIndex("Registro eliminado correctamente!!!");
    } catch (PDOException $e) {
        // En caso de error, muestra un mensaje de error
        $errorMessage = "Error al eliminar el registro: " . $e->getMessage();
        redirectToIndex($errorMessage);
    }
} else {
    // Si no se proporciona un ID de producto, redirige de vuelta al index con un mensaje de error
    redirectToIndex("ID de producto no especificado.");
}

// Función para redirigir de vuelta al index con un mensaje
function redirectToIndex($message) {
    echo "<script>
            alert('$message');
            window.location.href = 'http://localhost/inventario-excel/';
          </script>";
    exit();
}

// Cierra la conexión a la base de datos
$conn = null;
?>

