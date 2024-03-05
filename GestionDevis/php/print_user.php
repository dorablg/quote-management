<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $query = "SELECT * FROM utilisateurs WHERE id_utilisateur = $user_id";
    $result = $connexion->query($query);

    if ($result && $result->num_rows > 0) {
        $user_data = $result->fetch_assoc();

  
        $print_content = "
            <h1>User Details</h1>
            <p><strong>Name:</strong> {$user_data['nom']}</p>
            <p><strong>Prénom:</strong> {$user_data['prenom']}</p>
            <p><strong>Numéro de Téléphone:</strong> {$user_data['numero_telephone']}</p>
            <p><strong>Adresse Email:</strong> {$user_data['adresse_email']}</p>
            <p><strong>role:</strong> {$user_data['role']}</p>
        ";


        echo $print_content;
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
