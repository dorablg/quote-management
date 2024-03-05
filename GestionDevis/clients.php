<?php
require 'connect.php';
include('css.php');
include('header.php');
include('left.php');

$clients_per_page = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($current_page - 1) * $clients_per_page;

$sql = "SELECT * FROM clients LIMIT $start, $clients_per_page";
$result = $connexion->query($sql);

$total_clients_result = $connexion->query("SELECT COUNT(*) FROM clients");
$total_clients_row = $total_clients_result->fetch_row();
$total_clients = $total_clients_row[0];

$total_pages = ceil($total_clients / $clients_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients List</title>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h1>Clients List</h1>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Numéro de Téléphone</th>
                    <th>Adresse</th>
                    <th>Email</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_client']; ?></td>
                        <td><?php echo $row['nom']; ?></td>
                        <td><?php echo $row['prenom']; ?></td>
                        <td><?php echo $row['numero_telephone']; ?></td>
                        <td><?php echo $row['adresse']; ?></td>
                        <td><?php echo $row['adresse_email']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
         <?php include ('footer.php');  ?>
</body>
</html>



    



