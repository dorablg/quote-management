<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Quote</title>
</head>
<body>
    <?php
    require 'connect.php';

    $num_devis = null;
    $client = $remise = $tva = null;
    $article1_produit = $article1_quantite = $article1_prix = null;
    $article2_produit = $article2_quantite = $article2_prix = null;
    $article3_produit = $article3_quantite = $article3_prix = null;

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $num_devis = $_GET['id'];

        $query = "SELECT * FROM devis WHERE num_devis = $num_devis";
        $result = $connexion->query($query);

        if ($result->num_rows == 1) {
            $quote = $result->fetch_assoc();
            $client = $quote['client'];
            $remise = $quote['remise'];
            $tva = $quote['tva'];
			$date=$quote['date'];
			$status=$quote['status'];
			$facture=$quote['facture'];
            $article1_produit = $quote['article1_produit'];
            $article1_quantite = $quote['article1_quantite'];
            $article1_prix = $quote['article1_prix'];
            $article2_produit = $quote['article2_produit'];
            $article2_quantite = $quote['article2_quantite'];
            $article2_prix = $quote['article2_prix'];
            $article3_produit = $quote['article3_produit'];
            $article3_quantite = $quote['article3_quantite'];
            $article3_prix = $quote['article3_prix'];
        } else {
            echo "Quote not found.";
            exit;
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num_devis = $_POST['num_devis'];
        $client = $_POST["client"];
        $remise = $_POST["remise"];
        $tva = $_POST["tva"];
		$date = $_POST["date"];  
        $status = $_POST["status"]; 
        $facture = $_POST["facture"];
        $article1_produit = $_POST["article1_produit"];
        $article1_quantite = $_POST["article1_quantite"];
        $article1_prix = $_POST["article1_prix"];
        $article2_produit = $_POST["article2_produit"];
        $article2_quantite = $_POST["article2_quantite"];
        $article2_prix = $_POST["article2_prix"];
        $article3_produit = $_POST["article3_produit"];
        $article3_quantite = $_POST["article3_quantite"];
        $article3_prix = $_POST["article3_prix"];

        $update_query = "UPDATE devis SET client = '$client', remise = '$remise', tva = '$tva',date = '$date', status = '$status', facture = '$facture', article1_produit = '$article1_produit', article1_quantite = '$article1_quantite', article1_prix = '$article1_prix', article2_produit = '$article2_produit', article2_quantite = '$article2_quantite', article2_prix = '$article2_prix', article3_produit = '$article3_produit', article3_quantite = '$article3_quantite', article3_prix = '$article3_prix' WHERE num_devis = $num_devis";

        $update_result = $connexion->query($update_query);

        if ($update_result) {
            header("Location: indexpage.php");
            exit;
        } else {
            echo "Error updating quote: " . $connexion->error;
        }
    }
    ?>

    <h1>Edit Quote</h1>
    <form method="post">
        <input type="hidden" name="num_devis" value="<?php echo $num_devis; ?>">

        <label for="client">Client:</label>
        <input type="text" id="client" name="client" value="<?php echo $client; ?>"><br>

        <label for="remise">Remise:</label>
        <input type="text" id="remise" name="remise" value="<?php echo $remise; ?>"><br>

        <label for="tva">TVA:</label>
        <input type="text" id="tva" name="tva" value="<?php echo $tva; ?>"><br>
<br>

        <label for="date">DATE:</label>
        <input type="text" id="tva" name="date" value="<?php echo $date; ?>"readonly> <br>
<br>

        <label for="status">Status:</label>
        <select id="status" name="status">
        
  <?php
    $status_query = "SELECT * FROM status";
    $status_result = $connexion->query($status_query);
    while ($status_row = $status_result->fetch_assoc()) {
        $selected = ($status_row['status'] == $status) ? 'selected' : '';
        echo "<option value='{$status_row['status']}' $selected>{$status_row['status']}</option>";
    }
    ?>
</select><br>

        <label for="facture">facture:</label>
        <input type="text" id="facture" name="facture" value="<?php echo $facture; ?>"><br>


        <h2>Article 1</h2>
        <label for="article1_produit">Produit:</label>
        <input type="text" id="article1_produit" name="article1_produit" value="<?php echo $article1_produit; ?>"><br>
        <label for="article1_quantite">Quantité:</label>
        <input type="text" id="article1_quantite" name="article1_quantite" value="<?php echo $article1_quantite; ?>"><br>
        <label for="article1_prix">Prix:</label>
        <input type="text" id="article1_prix" name="article1_prix" value="<?php echo $article1_prix; ?>"><br>
         <h2>Article 2</h2>
        <label for="article2_produit">Produit:</label>
        <input type="text" id="article2_produit" name="article2_produit" value="<?php echo $article2_produit; ?>"><br>
        <label for="article2_quantite">Quantité:</label>
        <input type="text" id="article2_quantite" name="article2_quantite" value="<?php echo $article2_quantite; ?>"><br>
        <label for="article2_prix">Prix:</label>
        <input type="text" id="article2_prix" name="article2_prix" value="<?php echo $article2_prix; ?>"><br>
		 <h2>Article 3</h2>
        <label for="article3_produit">Produit:</label>
        <input type="text" id="article3_produit" name="article3_produit" value="<?php echo $article3_produit; ?>"><br>
        <label for="article3_quantite">Quantité:</label>
        <input type="text" id="article3_quantite" name="article3_quantite" value="<?php echo $article2_quantite; ?>"><br>
        <label for="article3_prix">Prix:</label>
        <input type="text" id="article3_prix" name="article3_prix" value="<?php echo $article3_prix; ?>"><br>
        
        <button type="submit">Update Quote</button>
    </form>
</body>
</html>
