<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
<script>
function showDeleteConfirmation(id) {
    const confirmation = confirm("Are you sure you want to delete this user?");
    if (confirmation) {
        window.location.href = `delete_user.php?id=${id}`;
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
        
  
       <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Utilisateurs List</title>
    
</head>
<body>
    <?php require 'connect.php';
	 ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    $users_per_page = 10;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($current_page - 1) * $users_per_page;

    $sql = "SELECT * FROM utilisateurs LIMIT $start, $users_per_page";
    $result = $connexion->query($sql);

    $total_users_result = $connexion->query("SELECT COUNT(*) FROM utilisateurs");
    $total_users_row = $total_users_result->fetch_row();
    $total_users = $total_users_row[0];

    $total_pages = ceil($total_users / $users_per_page);
    ?>
	 <div class="container">
        <div class="main-content">
            <h1>Utilisateurs List</h1>
            <p><a href="add_user.php">Add User</a></p>
            <div class="search-box">
                <form action="utilisateurs.php" method="get">
                    <div style="display: flex; align-items: center;">
                        <input type="text" name="search" placeholder="Search users"
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
                    <th>Prénom</th>
                    <th>Numéro de Téléphone</th>
                    <th>Adresse Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <?php
                if (isset($_GET["search"])) {
                    $search = $_GET["search"];
                    $query = "SELECT * FROM utilisateurs WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' OR adresse_email LIKE '%$search%'";
                } else {
                    $query = "SELECT * FROM utilisateurs";
                }

                $result = $connexion->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_utilisateur'] . "</td>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['prenom'] . "</td>";
                    echo "<td>" . $row['numero_telephone'] . "</td>";
                    echo "<td>" . $row['adresse_email'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_user.php?id=" . $row['id_utilisateur'] . "'><img src='images/edit.png' alt='Edit' style='width: 20px; height: 20px;'></a> ";
                  echo "<a href='javascript:void(0);' onclick='showDeleteConfirmation(" . $row['id_utilisateur'] . ")'><img src='images/delete.png' alt='Delete' style='width: 20px; height: 20px;'></a> ";
                   
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>
        <?php include('down.php'); ?>
    </td>
  </tr>
</table>
</body>
</html>



