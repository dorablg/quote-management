<?php
require('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $num_tel = $_POST["num_tel"];
    $email = $_POST["email"];
    $besoin = $_POST["besoin"];

    $query = "INSERT INTO clients (nom, prenom, numero_telephone, adresse_email, besoin) 
              VALUES ('$nom', '$prenom', '$num_tel', '$email', '$besoin')";

    $success = $connexion->query($query);

    if ($success) {
        header("Location: listeclients.php");
        exit;
    } else {
        echo "Error adding client: " . $connexion->error;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Client</title>
</head>
<body>
<form action="add_client.php" method="post">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required><br>
    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" required><br>
    <label for="num_tel">Numéro de téléphone:</label>
    <input type="text" id="num_tel" name="num_tel" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="besoin">Besoin:</label>
   <select id="besoin" name="besoin" required>
    <?php
    $besoinQuery = "SELECT * FROM besoin";
    $besoinResult = $connexion->query($besoinQuery);
    
    while ($besoinRow = $besoinResult->fetch_assoc()) {
        $besoinValue = $besoinRow['besoin']; 
        echo "<option value='$besoinValue'>$besoinValue</option>";
    }

    ?>
</select><br>
    <button type="submit">Add Client</button>
</form>
<br>
<form action="listeclients.php">
    <button type="submit">Return </button>
</form>
