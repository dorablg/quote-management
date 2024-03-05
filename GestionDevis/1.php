<?php /*?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application</title>
    <style>
	 body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .menu {
            flex: 1;
            background-color: #20232a;
            color: white;
            padding: 20px;
        }
        .content {
            flex: 3;
            padding: 20px;
        }
        .menu-item {
            margin-bottom: 10px;
            cursor: pointer;
        }
        .menu-item:hover {
            background-color: #4CAF50;
        }
		.left-menu {
   			 background-color: #f0f0f0; 
    		 height: 100vh; 
   			 width: 250px; 
   			 float: left;
		}
		.main-content {
    		margin-left: 250px; 
            padding: 20px;
}
    </style>

<body>
        <div class="container">
        <div class="menu">
            <h2>Menu</h2>
            <div class="menu-item">Quote Status</div>
            <div class="menu-item">Users</div>
            <div class="menu-item">Clients</div>
            <div class="menu-item">Products</div>
        </div>           
                
            <?php
         
require 'connect.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page === 'users') {
        include 'users.php';
    } elseif ($page === 'clients') {
        include 'clients.php';
    } else {
        include 'products.php';
    }
} else {
    $quoteDetailsQuery = "SELECT * FROM devis";
    $quoteDetailsResult = $connexion->query($quoteDetailsQuery);

    if ($quoteDetailsResult->num_rows > 0) {
        echo '<table>';
        echo '<tr>
                <th>Devis ID</th>
                <th>Client ID</th>
                <th>Product ID</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Remise</th>
              </tr>';
        while ($quote = $quoteDetailsResult->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $quote['id_devis'] . '</td>';
            echo '<td>' . $quote['id_client'] . '</td>';
            echo '<td>' . $quote['id_produit'] . '</td>';
            echo '<td>' . $quote['quantite'] . '</td>';
            echo '<td>' . $quote['prix'] . '</td>';
            echo '<td>' . $quote['remise'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No quote details available.';
    }
}
?>

  
</body>
</html><?php */?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application</title>
    <style>
       
        body, h1, h2, p {
            margin: 0;
            padding: 0;
        }

       
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .menu {
            flex: 1;
            background-color: #283747;
            color: blue;
            padding: 20px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .content {
            flex: 3;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .menu-item {
            margin-bottom: 10px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 5px;
        }
        .menu-item a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        .menu-item:hover {
            background-color: #34495e;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #283747;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
  <!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
  <div class="container">
      <nav class="menu">
          <div class="menu-item"><a href=   "index.php?page=quoteStatus">Quote Status</a>
          <div class="menu-item"><a href="index.php?page=users">Users</a>
          <div class="menu-item"><a href="index.php?page=clients">Clients</a>
           <div class="menu-item"><a href="index.php?page=products">Products</a>
        
    </div>
    <div class="content">
        <div class="main-content" id="content">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                if ($page === 'quoteStatus') {
                    include 'quoteStatus.php';
                } elseif ($page === 'users') {
                    include 'users.php';
                } elseif ($page === 'clients') {
                    include 'clients.php';
                } elseif ($page === 'products') {
                    include 'products.php';
                }
            } else {
                echo "<h2>Welcome to the Dashboard!</h2>";
                echo "<p>Select a menu item to view its content.</p>";
            }
            ?>
            <h1>Quote Details</h1>
            <?php
            require 'connect.php'; 

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
    </div>
</body>