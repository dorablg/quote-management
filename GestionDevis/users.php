<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>
<style>
 
</style>
<?php
require 'connect.php';
 include('css.php');
 include('header.php');
 include('left.php'); 


$users_per_page = 10;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($current_page < 1) {
    $current_page = 1;
}

$start = ($current_page - 1) * $users_per_page;

$total_users_query = $connexion->query("SELECT COUNT(*) FROM utilisateurs");

if ($total_users_query) {
    $total_users_row = $total_users_query->fetch_row();
    $total_users = $total_users_row[0];

    $sql = "SELECT * FROM utilisateurs LIMIT $start, $users_per_page";
    $result = $connexion->query($sql);

    if ($result) { 
        $total_pages = ceil($total_users / $users_per_page);
    } else {
        echo "Query failed: " . $connexion->error;
    }
} else {
    echo "Total users query failed: " . $connexion->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
       
    </style>
</head>
<body>
    <div class="container">
        
        <div class="main-content">
            <h1>Users List</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Numéro de Téléphone</th>
                    <th>Adresse</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Payment</th>
                </tr>
                <?php 
                if ($result) {
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_utilisateur']; ?></td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['prenom']; ?></td>
                            <td><?php echo $row['numero_telephone']; ?></td>
                            <td><?php echo $row['adresse']; ?></td>
                            <td><?php echo $row['adresse_email']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td><?php echo $row['payment']; ?></td>
                        </tr>
                    <?php endwhile;
                } else {
                    echo "No user data available.";
                }
                ?>
            </table>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
               
           
    </div>
     <?php include('footer.php'); ?>
</body>
</html>

