<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_product = $_GET['id'];

  
    $deleteQuery = "DELETE FROM produits WHERE id = ?";
    
    $stmt = $connexion->prepare($deleteQuery);
    $stmt->bind_param("i", $id_product);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: listeproduits.php");
        exit();
    } else {
        echo "Error deleting record: " . $connexion->error;
    }
}
?>


