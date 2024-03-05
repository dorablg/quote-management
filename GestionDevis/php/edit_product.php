<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM produits WHERE id = $id";
    $result = $connexion->query($query);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nom = $row['nom'];
        $description = $row['description'];
        $prix = $row['prix'];
    } else {
        echo "Product not found.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];

    $update_query = "UPDATE produits SET nom = '$nom', description = '$description', prix = '$prix' WHERE id = $id";
    $update_result = $connexion->query($update_query);

    if ($update_result) {
        header("Location: listeproduits.php");
        exit;
    } else {
        echo "Error updating product: " . $connexion->error;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>"><br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $description; ?>"><br>
        <label for="prix">Price:</label>
        <input type="number" id="prix" name="prix" value="<?php echo $prix; ?>"><br>
        
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>


