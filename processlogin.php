<?php

include 'connection.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

// Prepare the SQL statement using prepared statement
$stmt = $connect->prepare("SELECT * FROM students WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// If the query returns a row, the user exists and the password is correct
if(mysqli_num_rows($result) == 1) {
    $row = $result->fetch_assoc();
    if(password_verify($password, $row['password'])) {
        if($row['is_verified'] == 1) {
            $_SESSION['e-mail'] = $email;
            header('Location: welcome.php');
            exit;
        } else {
            $_SESSION['login_error'] = 'Email not verified !!!';
            header('Location: login.php');
            exit;
        }
    } else {
        $_SESSION['login_error'] = 'Incorrect Password !!!';
        header('Location: login.php');
        exit;
    }
} else {
    // If the query returns no rows, the user does not exist or the password is incorrect
    $_SESSION['login_error'] = 'Invalid Email or Password !!!';
    header('Location: login.php');
    exit;
}
}
?>
