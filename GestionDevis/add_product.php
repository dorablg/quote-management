<?php
require('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];

    $query = "INSERT INTO produits (nom, description, prix) 
              VALUES ('$nom', '$description', '$prix')";
    $success = $connexion->query($query);

    if ($success) {
        header("Location: listeproduits.php");
        exit;
    } else {
        echo "Error adding product: " . $connexion->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <form action="add_product.php" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        <label for="prix">Prix:</label>
        <input type="text" id="prix" name="prix" required><br>
        <button type="submit">Add Product</button>
    </form>
    
    <br>
    
    <form action="listeproduits.php">
        <button type="submit">Return to Product List</button>
    </form>
</body>
</html>

