<?php
require 'connect.php';

$id_utilisateur = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_utilisateur = $_GET['id'];

    $query = "SELECT * FROM utilisateurs WHERE id_utilisateur = $id_utilisateur";
    $result = $connexion->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $numero_telephone = $row['numero_telephone'];
        $adresse_email = $row['adresse_email'];
        $role = $row['role'];
    } else {
        echo "User not found.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_utilisateur = $_POST['id_utilisateur'];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $numero_telephone = $_POST["numero_telephone"];
    $adresse_email = $_POST["adresse_email"];
    $role = $_POST["role"];

    $update_query = "UPDATE utilisateurs SET nom = '$nom', prenom = '$prenom', numero_telephone = '$numero_telephone', adresse_email = '$adresse_email', role = '$role' WHERE id_utilisateur = $id_utilisateur";
    $update_result = $connexion->query($update_query);

    if ($update_result) {
        header("Location: utilisateurs.php");
        exit;
    } else {
        echo "Error updating user: " . $connexion->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="post">

        <input type="hidden" name="id_utilisateur" value="<?php echo $id_utilisateur; ?>">

        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>"><br>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>"><br>
        <label for="numero_telephone">Numéro de Téléphone:</label>
        <input type="text" id="numero_telephone" name="numero_telephone" value="<?php echo $numero_telephone; ?>"><br>
        <label for="adresse_email">Adresse Email:</label>
        <input type="email" id="adresse_email" name="adresse_email" value="<?php echo $adresse_email; ?>"><br>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <?php
            $roleQuery = "SELECT * FROM roles";
            $roleResult = $connexion->query($roleQuery);

            while ($roleRow = $roleResult->fetch_assoc()) {
                $roleValue = $roleRow['role'];
                $selected = ($roleValue == $role) ? "selected" : "";
                echo "<option value='$roleValue' $selected>$roleValue</option>";
            }
            ?>
        </select><br>
        <button type="submit">Update User</button>
    </form>
</body>
</html>

