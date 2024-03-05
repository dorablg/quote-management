<?php
require 'connect.php';

$id_client = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_client = $_GET['id'];

    $query = "SELECT * FROM clients WHERE id_client = $id_client";
    $result = $connexion->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $numero_telephone = $row['numero_telephone'];
        $adresse_email = $row['adresse_email'];
        $besoin = $row['besoin'];
    } else {
        echo "Client not found.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_client = $_POST['id_client'];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $numero_telephone = $_POST["numero_telephone"];
    $adresse_email = $_POST["adresse_email"];
    $besoin = $_POST["besoin"];

    $update_query = "UPDATE clients SET nom = '$nom', prenom = '$prenom', numero_telephone = '$numero_telephone', adresse_email = '$adresse_email', besoin = '$besoin' WHERE id_client = $id_client";
    $update_result = $connexion->query($update_query);

    if ($update_result) {
        header("Location: listeclients.php");
        exit;
    } else {
        echo "Error updating client: " . $connexion->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Client</title>
</head>
<body>
    <h1>Edit Client</h1>
    <form method="post">

        <input type="hidden" name="id_client" value="<?php echo $id_client; ?>">

        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>"><br>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>"><br>
        <label for="numero_telephone">Numéro de Téléphone:</label>
        <input type="text" id="numero_telephone" name="numero_telephone" value="<?php echo $numero_telephone; ?>"><br>
        <label for="adresse_email">Adresse Email:</label>
        <input type="email" id="adresse_email" name="adresse_email" value="<?php echo $adresse_email; ?>"><br>
        <label for="besoin">Besoin:</label>
<select id="besoin" name="besoin" required>
    <?php
    $besoinQuery = "SELECT * FROM besoin";
    $besoinResult = $connexion->query($besoinQuery);

    while ($besoinRow = $besoinResult->fetch_assoc()) {
        $besoinValue = $besoinRow['besoin'];
        $selected = ($besoinValue == $besoin) ? "selected" : "";
        echo "<option value='$besoinValue' $selected>$besoinValue</option>";
    }
    ?>
</select><br>

        <button type="submit">Update Client</button>
    </form>
</body>
</html>
