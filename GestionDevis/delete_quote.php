<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $quoteId = $_GET['id'];

    $deleteQuery = "DELETE FROM devis WHERE num_devis = $quoteId";
    if ($connexion->query($deleteQuery) === true) {
        header("Location: indexpage.php");
        exit();
    } else {
        echo "Error deleting record: " . $connexion->error;
    }
}
?>
