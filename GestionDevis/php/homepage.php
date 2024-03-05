<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
   
</head>
<body>

    <div class="container">
       <?php 
	   		require 'connect.php'; 
	   		include('css.php');
	   		include('header.php'); 
			
            include('left.php'); ?> 
       <div class="content">
            <div class="main-content" id="content">
              <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page === 'quoteStatus') {
                        include 'quoteStatus.php';
                    } elseif ($page === 'users') {
                        include 'utilisateurs.php';
                    } elseif ($page === 'clients') {
                        include 'listeclients.php';
                    } elseif ($page === 'products') {
                        include 'listeproduits.php';
                    }
                } else {
                    echo "<h2>Welcome to the Dashboard!</h2>";
                    
                }
                ?>
                <h1>Quote Details</h1>
                <?php
                

                $quoteDetailsQuery = "SELECT * FROM devis";
                $quoteDetailsResult = $connexion->query($quoteDetailsQuery);

                if ($quoteDetailsResult->num_rows > 0) {
                    echo '<table border="1">';
                    echo '<tr>';
                    echo '<th>Devis ID</th>';
                    echo '<th>Client ID</th>';
                    echo '<th>Product ID</th>';
                    echo '<th>Quantité</th>';
                    echo '<th>Prix</th>';
                    echo '<th>Remise</th>';
                    echo '<th>TVA</th>';
                    echo '</tr>';
                    
                    while ($quote = $quoteDetailsResult->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $quote['id_devis'] . '</td>';
                        echo '<td>' . $quote['id_client'] . '</td>';
                        echo '<td>' . $quote['id_produit'] . '</td>';
                        echo '<td>' . $quote['quantite'] . '</td>';
                        echo '<td>' . $quote['prix'] . '</td>';
                        echo '<td>' . $quote['remise'] . '</td>';
                        echo '<td>' . $quote['tva'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No quote details available</p>';
                }
                ?>
            </div>
       <?php include ('footer.php');  ?>
  </body>

</html>
