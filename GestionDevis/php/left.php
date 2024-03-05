<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Left Menu</title>
 
</head>
<body>
    <td width="323" height="214" align="left" valign="top" style="min-height: 700px; font-family: 'Times New Roman', Times, serif; font-weight: bold; font-size: 18px;">
        <p class="left-menu"><a href="indexpage.php"><strong>quotestatus</strong></a></p>

        <strong>
        <?php
		include('css.php');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Include your database connection code here
        require 'connect.php';

        // Variables to store the number of quotes in each status
        $countCreer = 0;
        $counteAttente = 0;
        $countTerminer= 0;

        // Query to fetch all quotes from the devis table
        $quotesQuery = "SELECT * FROM devis";
        $quotesResult = $connexion->query($quotesQuery);

        if ($quotesResult === false) {
            echo json_encode(['error' => 'Error executing quotes query: ' . $connexion->error]);
        } else {
            while ($row = $quotesResult->fetch_assoc()) {
                $status = strtolower($row['status']); 

               
                switch ($status) {
                    case 'crée':
                        $countCreer++;
                        break;
                    case 'en cours':
                        $counteAttente++;
                        break;
                    case 'terminé':
                        $countTerminer++;
                        break;
                }
            }
        }

        // Display the number of quotes for each status
        echo '<div class="status-counts">';
        echo '<h2>Status Counts</h2>';
        echo '<ul>';

        echo '<li>Creer: <span class="count">' . $countCreer . '</span></li>';
        echo '<li>Attente: <span class="count">' . $counteAttente . '</span></li>';
        echo '<li>Termine: <span class="count">' . $countTerminer . '</span></li>';

        echo '</ul>';
        echo '</div>';
        ?>

        </strong>
        <p class="left-menu"><strong><a href="utilisateurs.php">users</a></strong></p>
        <p class="left-menu"><strong><a href="listeclients.php">clients</a></strong><span style="text-align: left"></span></p>
        <p class="left-menu"><strong><a href="listeproduits.php">products</a></strong><a href="listeproduits.php"></a></p>
        <p class="left-menu">&nbsp;</p>
        <p class="left-menu">&nbsp;</p>
        <p class="left-menu">&nbsp;</p>




        <div class="bottom-left-menu">
           
          <p  class="left-menu"><a href="about.php">About</a></p>
          <p  class="left-menu"><a href="help.php">Help</a></p>
          <p  class="left-menu"><a href="contact.php">Contact Us</a></p>
        </div>
    </td>
</body>
</html>
