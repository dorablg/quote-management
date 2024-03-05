<?php /*?><?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'your_username' && $password === 'your_password') {
        $_SESSION['user_id'] = 1; 
        header("Location: index.php"); 
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
<?php */?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <!-- Include necessary CSS styles here -->
</head>
<body>
  <h1>Login</h1>
  <form action="authenticate.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username">
    <label for="password">Password:</label>
    <input type="password" name="password">
    <button type="submit">Login</button>
  </form>
</body>
</html>
