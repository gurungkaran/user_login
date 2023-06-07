<?php

include 'connection.php';

session_start();
if(!isset($_SESSION['e-mail'])){
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="style.css">
    <div class="container">
        <div class="content">
            <h1>Welcome !!</h1>
            <p>Hello, <span><?php echo $_SESSION['e-mail'];?></span></p>
            <p>This is your page</p>
            <a href="login.php" class="btn">Logout</a>
        </div>
    </div>
    <footer>
        <p>&copy; 2023 My Website. All rights reserved.</p>
    </footer>

</body>

</html>