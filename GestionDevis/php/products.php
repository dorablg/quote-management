<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>
<?php
require 'connect.php';
include('css.php');
include('header.php');
include('left.php');

$products_per_page = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($current_page - 1) * $products_per_page;

$sql = "SELECT * FROM produits LIMIT $start, $products_per_page";
$result = $connexion->query($sql); 

$total_products_result = $connexion->query("SELECT COUNT(*) FROM produits");
$total_products_row = $total_products_result->fetch_row();
$total_products = $total_products_row[0];

$total_pages = ceil($total_products / $products_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h1>Product List</h1>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nom']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['prix']; ?></td>
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
