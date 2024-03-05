<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Clients List</title>
    <script>
function showDeleteConfirmation(id) {
    const confirmation = confirm("Are you sure you want to delete this client?");
    if (confirmation) {
        window.location.href = `delete_client.php?id=${id}`;
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
            <?php require 'connect.php';

            $clients_per_page = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($current_page - 1) * $clients_per_page;

            $sql = "SELECT * FROM clients LIMIT $start, $clients_per_page";
            $result = $connexion->query($sql);

            $total_clients_result = $connexion->query("SELECT COUNT(*) FROM clients");
            $total_clients_row = $total_clients_result->fetch_row();
            $total_clients = $total_clients_row[0];

            $total_pages = ceil($total_clients / $clients_per_page);
            ?>
            <div class="container">
                <div class="main-content">
                    <h1>Clients List</h1>
                    <p><a href="add_client.php">Add Client</a></p>
                    <div class="search-box">
                        <form action="listeclients.php" method="get">
                            <div style="display: flex; align-items: center;">
                                <input type="text" name="search" placeholder="Search clients"
                                       style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                                <button type="submit" style="background: none; border: none;">
                                    <img src="images/Vector_search_icon.svg.png" alt="Search" style="width: 20px; height: 20px;">
                                </button>
                            </div>
                        </form>
                    </div>
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Numéro de Téléphone</th>
                            <th>Email</th>
                            <th>Besoin</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if (isset($_GET["search"])) {
                            $search = $_GET["search"];
                            $query = "SELECT * FROM clients WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' OR numero_telephone LIKE '%$search%' OR adresse_email LIKE '%$search%'";
                            $result = $connexion->query($query);
                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id_client'] . "</td>";
                            echo "<td>" . $row['nom'] . "</td>";
                            echo "<td>" . $row['prenom'] . "</td>";
                            echo "<td>" . $row['numero_telephone'] . "</td>";
                            echo "<td>" . $row['adresse_email'] . "</td>";
                            echo "<td>" . $row['besoin'] . "</td>";
                            echo "<td>";
                    echo "<a href='edit_client.php?id=" . $row['id_client'] . "'><img src='images/edit.png' alt='Edit' style='width: 20px; height: 20px;'></a> ";
                    echo "<a href='javascript:void(0);' onclick='showDeleteConfirmation(" . $row['id_client'] . ")'><img src='images/delete.png' alt='Delete' style='width: 20px; height: 20px;'></a> ";
                   
                    echo "</td>";
							echo "</tr>";
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
            <?php include('down.php'); ?>
        </td>
    </tr>
</table>
</body>
</html>
