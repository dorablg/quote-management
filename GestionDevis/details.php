<?php
require('connect.php');
 
if (isset($_GET['id'])) {
    $quoteId = $_GET['id'];

    
    $quoteDetailsQuery = "SELECT * FROM devis WHERE num_devis = ?";
    

    $stmt = $connexion->prepare($quoteDetailsQuery);
    $stmt->bind_param("i", $quoteId); 
    $stmt->execute();
    
  
    $quoteDetailsResult = $stmt->get_result();

   
    if ($quoteDetailsResult->num_rows === 1) {
       
        $quote = $quoteDetailsResult->fetch_assoc();

        
        echo '<p>N° Devis: ' . $quote['num_devis'] . '</p>';
        echo '<p>Client: ' . $quote['client'] . '</p>';
        echo '<p>Date: ' . $quote['date'] . '</p>';
        echo '<p>stauts: ' . $quote['status'] . '</p>';
        echo '<p>facture: ' . $quote['facture'] . '</p>';
        
       
        for ($i = 1; $i <= 3; $i++) {
            echo '<p>Article ' . $i . ' Product: ' . $quote["article{$i}_produit"] . '</p>';
            echo '<p>Article ' . $i . ' Quantity: ' . $quote["article{$i}_quantite"] . '</p>';
            echo '<p>Article ' . $i . ' Prix: ' . $quote["article{$i}_prix"] . '</p>';
		
		}
     echo '<p>Remise: ' . $quote['remise'] . '</p>';
     echo '<p>TVA: ' . $quote['tva'] . '</p>';  
    } else {
       
        echo "Quote not found.";
	
    }
} else {
   
    echo "Invalid request.";
}
?>