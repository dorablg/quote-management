<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_utilisateur = $_GET['id'];

    // Use prepared statement
    $deleteQuery = "DELETE FROM utilisateurs WHERE id_utilisateur = ?";
    
    $stmt = $connexion->prepare($deleteQuery);
    $stmt->bind_param("i", $id_utilisateur);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: utilisateurs.php");
        exit();
    } else {
        echo "Error deleting record: " . $connexion->error;
    }
}
?>
