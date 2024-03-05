<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Quote Details</title>
    <script>
function showDeleteConfirmation(id) {
    const confirmation = confirm("Are you sure you want to delete this quote?");
    if (confirmation) {
        window.location.href = `delete_quote.php?id=${id}`;
    }
}

</script>
</head>

    <table width="100%" height="442" border="1">
        <?php include('top.php');
		include('css.php'); ?>

        <p>&nbsp;</p>
        <tr>

            <?php include('left.php'); ?>
            <td colspan="2" align="left" valign="top" style="min-height:800px">
                <div class="container">
                    <?php
                    require 'connect.php';

                    $quoteDetailsQuery = "SELECT * FROM devis";

                    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
                        $search = $_GET['search'];
                        $quoteDetailsQuery = "SELECT * FROM devis WHERE num_devis LIKE '%$search%' OR client LIKE '%$search%' OR remise LIKE '%$search%' OR tva LIKE '%$search%'";
                    }

                    $quoteDetailsResult = $connexion->query($quoteDetailsQuery);

                    if ($quoteDetailsResult === false) {
                        echo "Error executing query: " . $connexion->error;
                    } else {
                        ?>
                        <div class="content">
                            <div class="main-content" id="content">
                                <h1>Quote Details</h1>
                                <p><a href="add_quote.php">Add Quote</a></p>
                                <div class="search-box">
                                    <form action="indexpage.php" method="get">
                                        <div style="display: flex; align-items: center;">
                                            <input type="text" name="search" placeholder="Search clients" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                                            <button type="submit" style="background: none; border: none;">
                                                <img src="images/Vector_search_icon.svg.png" alt="Search" style="width: 20px; height: 20px;">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <?php
                                if ($quoteDetailsResult->num_rows > 0) {
                                    echo '<table border="1">';
                                    echo '<tr>';
                                    echo '<th>N° Devis</th>';
                                    echo '<th>Client</th>';
                                    echo '<th>Date</th>';
                                    echo '<th>status</th>';
                                    echo '<th>facture</th>';
                                    echo '<th>ACTION</th>';
                                    echo '</tr>';
                                    
                                    while ($quote = $quoteDetailsResult->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $quote['num_devis'] . '</td>';
                                        echo '<td>' . $quote['client'] . '</td>';
                                        echo '<td>' . $quote['date'] . '</td>';
										echo '<td>' . $quote['status'] . '</td>';
										echo '<td>' . $quote['facture'] . '</td>';
                                       '</td>';
										echo "<td>";
                    echo "<a href='edit_quote.php?id=" . $quote['num_devis'] . "'><img src='images/edit.png' alt='Edit' style='width: 20px; height: 20px;'></a> ";
                   
				    echo "<a href='details.php?id=" . $quote['num_devis'] . "'><img src='images/details.png' alt='details' style='width: 20px; height: 20px;'></a> ";
				   echo "<a href='javascript:void(0);' onclick='showDeleteConfirmation(" . $quote['num_devis'] . ")'><img src='images/delete.png' alt='Delete' style='width: 20px; height: 20px;'></a> ";

                   
                    echo "</td>";
                                        echo '</tr>';
                                    }
                                    echo '</table>';
                                } else {
                                    echo '<p>No quote details available</p>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <tr>
            <?php include('down.php'); ?>
        </tr>
    </table>
</body>
</html>
