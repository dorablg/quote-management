<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
<script>
function showDeleteConfirmation(id) {
    const confirmation = confirm("Are you sure you want to delete this product?");
    if (confirmation) {
        window.location.href = `delete_product.php?id=${id}`;
    }
}
</script>

</head>
  <body>
    <table width="100%" height="442" border="1">
        <?php include('top.php');
		include('css.php'); ?>
        
        <p>&nbsp;</p>
        <tr>
            
            <?php include('left.php'); ?>
            <td colspan="2" align="left" valign="top" style="min-height:800px">

<?php
require 'connect.php';
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

<div class="container">
    <div class="main-content">
        <h1>Product List</h1>
        <p><a href="add_product.php">Add Product</a></p>
        <div class="search-box">
            <form action="listeproduits.php" method="get">
              <div class="search-box">
            <form action="listeproduits.php" method="get">
                <div style="display: flex; align-items: center;">
             
                    <input type="text" name="search" placeholder="Search products"
                           style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                       
                        <img src="images/Vector_search_icon.svg.png" alt="Search" style="width: 20px; height: 20px;">
                    </button>
                </div>
            </form>
           
        </div>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Price</th>
                 <th>Actions</th>
            </tr>
            <?php
            if (isset($_GET["search"])) {
                $search = $_GET["search"];

                $query = "SELECT * FROM produits WHERE nom LIKE '%$search%'";
                $result = $connexion->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['prix'] . "</td>";
                    echo "</tr>";
                }
                $result->free();
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['prix'] . "</td>";
					echo "<td>";
					echo "<a href='edit_product.php?id=" . $row['id'] . "'><img src='images/edit.png' alt='Edit' style='width: 20px; height: 20px;'></a> ";
                     echo "<a href='javascript:void(0);' onclick='showDeleteConfirmation(" . $row['id'] . ")'><img src='images/delete.png' alt='Delete' style='width: 20px; height: 20px;'></a> ";
                    echo "</td>";
					echo "</tr>";
                }
                $result->free();
            }
            ?>
        </table>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    </div>
</div>
  <tr>
     <?php include('down.php'); ?>
  </tr>
</table>
</body>
</html>



  
  
 