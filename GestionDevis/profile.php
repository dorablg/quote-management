<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto;
            display: block;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }
        .profile-form {
            margin-top: 20px;
        }
        .profile-form label {
            display: block;
            margin-bottom: 5px;
        }
        .profile-form input[type="text"],
        .profile-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .profile-form input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .navigation-links {
            margin-top: 20px;
            text-align: center;
        }
        .navigation-links a {
            color: #3498db;
            text-decoration: none;
            margin: 0 10px;
		
		}.change-profile-pic-button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 8px 8px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="profile-container">
    <div class="profile-header">
        <h1>User Profile</h1>
        <img class="profile-picture" src="profile_picture.jpg" alt="Profile Picture">
        <button class="change-profile-pic-button">Change Profile Picture</button>
    </div>
    </div>

    <form class="profile-form" action="update_profile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="John Doe" required>

        <label for="email">Email:</label>
        <input type="text" name="email" value="johndoe@example.com" required>

        <label for="password">New Password:</label>
        <input type="password" name="new_password">

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" name="confirm_password">

        <input type="submit" value="Save Changes">
    </form>

    <div class="navigation-links">
        <a href="indexpage.php">Back to Main Page</a>
        <a href="logout.php">

