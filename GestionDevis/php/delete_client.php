<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_client = $_GET['id'];

  
    $deleteQuery = "DELETE FROM clients WHERE id_client = ?";
    
    $stmt = $connexion->prepare($deleteQuery);
    $stmt->bind_param("i", $id_client);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: listeclients.php");
        exit();
    } else {
        echo "Error deleting record: " . $connexion->error;
    }
}
?>

