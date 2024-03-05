<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>
<body>
	<?php include('css.php'); ?>
    <div class="container">
        <header class="header">
           <img src="images/logo-mediavision-PNG.png" alt="Logo">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-section">
                    <p>Welcome, User!</p>
                    <a href="logout.php">Logout</a>
                </div>
            <?php else: ?>
                <div class="login-section">
                    <a class="login-link" href="login.php">Login</a>
                </div>
            <?php endif; ?>
        </header>
        
    </div>
</body>
</html>
