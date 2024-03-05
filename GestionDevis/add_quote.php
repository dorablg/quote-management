
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('connect.php'); // Make sure to include your database connection script
$error_messages = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $client = $_POST["client"];

    // Convert remise and tva to float
    $remise = floatval($_POST["remise"]);
    $tva = floatval($_POST["tva"]);

    $date = $_POST["date"];
    $status = $_POST["status"];
    $facture = $_POST["facture"];

    $selected_article1_produit = $_POST["article1_produit"];
    $article1_quantite = $_POST["article1_quantite"];
    $article1_prix = fetchProductPriceFromDB($selected_article1_produit);

    $selected_article2_produit = $_POST["article2_produit"];
    $article2_quantite = $_POST["article2_quantite"];
    $article2_prix = fetchProductPriceFromDB($selected_article2_produit);

    $selected_article3_produit = $_POST["article3_produit"];
    $article3_quantite = $_POST["article3_quantite"];
    $article3_prix = fetchProductPriceFromDB($selected_article3_produit);

    if (empty($client) || empty($remise) || empty($tva)) {
        $error_messages[] = "Please fill in all required fields.";
    }

    if (empty($error_messages)) {
        $insert_query = "INSERT INTO devis (client, date, status, facture, article1_produit, article1_quantite, article1_prix, article2_produit, article2_quantite, article2_prix, article3_produit, article3_quantite, article3_prix, remise, tva) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Calculate total prices for each article
        $article1_total_price = $article1_quantite * $article1_prix;
        $article2_total_price = $article2_quantite * $article2_prix;
        $article3_total_price = $article3_quantite * $article3_prix;

        // Calculate the total price for the quote, including remise and TVA
        $total_quote_price = ($article1_total_price + $article2_total_price + $article3_total_price) * (1 - $remise / 100) * (1 + $tva / 100);

        $stmt = $connexion->prepare($insert_query);
        $stmt->bind_param(
            "sssssssssssssss",
            $client,
            $date,
            $status,
            $facture,
            $selected_article1_produit,
            $article1_quantite,
            $article1_total_price,
            $selected_article2_produit,
            $article2_quantite,
            $article2_total_price,
            $selected_article3_produit,
            $article3_quantite,
            $article3_total_price,
            $remise,
            $tva
        );

        if ($stmt->execute()) {
            header("Location: indexpage.php?page=quoteStatus");
            exit;
        } else {
            $error_messages[] = "Failed to insert data into the database.";
        }
    }
}

// Function to fetch product price from the database based on the product name
function fetchProductPriceFromDB($productName) {
    global $connexion; // Assuming $connexion is your database connection

    // Prepare and execute an SQL query to retrieve the price for the selected product
    $query = "SELECT prix FROM produits WHERE nom = ?";
    $stmt = $connexion->prepare($query);
    $stmt->bind_param("s", $productName);
    $stmt->execute();
    $stmt->bind_result($price);

    if ($stmt->fetch()) {
        // If the product is found in the database, return its price
        return $price;
    } else {
        return 0.00;
    }
}

$produit_query = "SELECT id_produit, nom FROM produits";
$produit_result_article1 = $connexion->query($produit_query);
$produit_result_article2 = $connexion->query($produit_query);
$produit_result_article3 = $connexion->query($produit_query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add Quote</title>
</head>
<body>
    <h1>Add Quote</h1>
    <form method="post">
        <label for="client">Client:</label>
        <select id="client" name="client">
            <option value="">Select a client</option>
            <?php
            $client_query = "SELECT nom FROM clients";
            $client_result = $connexion->query($client_query);
            while ($client_row = $client_result->fetch_assoc()) {
                echo "<option value='{$client_row['nom']}'>{$client_row['nom']}</option>";
            }
            ?>
        </select>

        <input type="hidden" name="status" value="crée">
        <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">

        <label for="article1_produit">Article 1:</label>
        <select id="article1_produit" name="article1_produit">
            <option value="">Select a product</option>
            <?php
            $produit_query_article1 = "SELECT nom FROM produits";
            $produit_result_article1 = $connexion->query($produit_query_article1);
            while ($produit_row = $produit_result_article1->fetch_assoc()) {
                echo "<option value='{$produit_row['nom']}'>{$produit_row['nom']}</option>";
            }
            ?>
        </select><br>

        <label for="article1_quantite">Quantity:</label>
        <input type="number" id="article1_quantite" name="article1_quantite">
        <label id="article1_calculated_price"></label><br>

        <label for="article2_produit">Article 2:</label>
        <select id="article2_produit" name="article2_produit">
            <option value="">Select a product</option>
            <?php
            $produit_query_article2 = "SELECT nom FROM produits";
            $produit_result_article2 = $connexion->query($produit_query_article2);
            while ($produit_row = $produit_result_article2->fetch_assoc()) {
                echo "<option value='{$produit_row['nom']}'>{$produit_row['nom']}</option>";
            }
            ?>
        </select><br>

        <label for="article2_quantite">Quantity:</label>
        <input type="number" id="article2_quantite" name="article2_quantite">
        <label id="article2_calculated_price"></label><br>

        <label for="article3_produit">Article 3:</label>
        <select id="article3_produit" name="article3_produit">
            <option value="">Select a product</option>
            <?php
            $produit_query_article3 = "SELECT nom FROM produits";
            $produit_result_article3 = $connexion->query($produit_query_article3);
            while ($produit_row = $produit_result_article3->fetch_assoc()) {
                echo "<option value='{$produit_row['nom']}'>{$produit_row['nom']}</option>";
            }
            ?>
        </select>

        <label for="article3_quantite">Quantity:</label>
        <input type="number" id="article3_quantite" name="article3_quantite">
        <label id="article3_calculated_price"></label><br>

        <label for="remise">Remise:</label>
        <input type="text" id="remise" name="remise"><br>

        <label for="tva">TVA:</label>
        <input type="text" id="tva" name="tva"><br>

        <button type="submit">Add Quote</button>
    </form>
    <script type="text/javascript">
        // Function to calculate and display the total price for an article
        function calculatePrice(articleId, quantityFieldId, priceFieldId) {
            var selectedProduct = document.getElementById(articleId + "_produit").value;
            var quantity = parseInt(document.getElementById(quantityFieldId).value);
            var price = parseFloat(fetchProductPrice(selectedProduct));

            if (!isNaN(quantity) && !isNaN(price)) {
                var total = (quantity * price).toFixed(2);
                document.getElementById(priceFieldId).textContent = "Price: $" + total;
            } else {
                document.getElementById(priceFieldId).textContent = "Price: $0.00";
            }
        }

        // Attach event listeners for price calculation
        document.getElementById("article1_quantite").addEventListener("input", function () {
            calculatePrice("article1", "article1_quantite", "article1_calculated_price");
        });

        document.getElementById("article2_quantite").addEventListener("input", function () {
            calculatePrice("article2", "article2_quantite", "article2_calculated_price");
        });

        document.getElementById("article3_quantite").addEventListener("input", function () {
            calculatePrice("article3", "article3_quantite", "article3_calculated_price");
        });

        // Function to fetch product price from the database
        function fetchProductPrice(productName) {
            var prices = <?php echo json_encode(fetchAllProductPrices()); ?>;
            return prices[productName] || 0.00;
        }

        // Function to fetch all product prices from the database
        function fetchAllProductPrices() {
            var prices = <?php echo json_encode(fetchAllPricesFromDB()); ?>;
            return prices;
        }
    </script>
</body>
</html>
