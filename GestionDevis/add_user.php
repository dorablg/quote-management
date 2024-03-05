<!DOCTYPE html>
<html>
<head>
  
</head>
<body>
    <h1>Add New User</h1>

<?php
require('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $num_tel = $_POST["num_tel"];
    $email = $_POST["email"];
    $role = $_POST["role"];
  

    $query = "INSERT INTO UTILISATEURS (nom, prenom, numero_telephone, adresse_email, role) 
              VALUES ('$nom', '$prenom',  '$num_tel', '$email', '$role')";
	 $success = $connexion->query($query);


    
     if ($success) {
       
        header("Location: utilisateurs.php");
        exit;
    } else {
        echo "Error adding user: " . $connexion->error;
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>
    <form action="add_user.php" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="prenom">Prénom:</label>
         <input type="text" id="prenom" name="prenom" required><br>
        <label for="num_tel">Numéro de téléphone:</label>
        <input type="text" id="num_tel" name="num_tel" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
		<label for="role">Role:</label>
    	<select id="role" name="role" required>
        <?php
        $roleQuery = "SELECT * FROM roles";
        $roleResult = $connexion->query($roleQuery);

        while ($roleRow = $roleResult->fetch_assoc()) {
            $roleValue = $roleRow['role'];
            echo "<option value='$roleValue'>$roleValue</option>";
        }
		?>
        </select><br>
        <button type="submit">Add User</button>
        <button onclick="redirectToUtilisateurs()">Return </button>
    
    	<script>
        function redirectToUtilisateurs() {
            window.location.href = "utilisateurs.php";
        }
    </script>
    </form>
</body>
</html>
