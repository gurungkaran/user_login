<?php

include 'connection.php';

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$v_code)
{
  require ("PHPMailer/PHPMailer.php");
  require ("PHPMailer/SMTP.php");
  require ("PHPMailer/Exception.php");

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'karangurung@ismt.edu.np';                     //SMTP username
    $mail->Password   = 'gurungkg39534';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->setFrom('karangurung@ismt.edu.np', 'KARAN GRG');
    $mail->addAddress($email);     
  
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email verification from karangurung';
    $mail->Body    = "Thanks for registration!
    Click this link to verify the email address
    <a href='http://localhost:4433/ismt/verify.php?email=$email&v_code=$v_code'>Verify</a>";

    $mail->send();
    return true;
  }
  catch (Exception $e) {
    return false;
}

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 // Retrieve form data
 $firstname = $_POST['firstname'];
 $lastname = $_POST['lastname'];
 $username = $_POST['username'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $confirm_password = $_POST['confirm_password'];
 $password_hash = password_hash($password, PASSWORD_BCRYPT);
 $cpassword_hash = password_hash($confirm_password, PASSWORD_BCRYPT);
 $v_code = bin2hex(random_bytes(16));

 // Validate form data
 $errors = array();

 //for username
 $sql = "SELECT `username` FROM `students` WHERE username = '$username'";
 $exesql = $connect->query($sql);

 if (empty($username)) {
   $errors[] = "Username is required.";
 } else if ($exesql->num_rows > 0) {
   $errors[] = "Username is already registered.";
 }

 //for email
 $sql = "SELECT `email` FROM `students` WHERE email = '$email'";
 $exesql = $connect->query($sql);

 if (empty($email)) {
   $errors[] = "Email is required.";
 } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   $errors[] = "Invalid email format.";
 } else if ($exesql->num_rows > 0) {
   $errors[] = "This email address is already registered.";
 }

 if (empty($password)) {
   $errors[] = "Password is required.";
 } else {
      if (strlen($password) < 8) {
          $errors[] = "Password must be at least 8 characters long.";
      }

       if (!preg_match('/[a-z]/', $password)) {
           $errors[] = "Password must contain at least one Small letter.";
       }
       if (!preg_match('/[A-Z]/', $password)) {
           $errors[] = "Password must contain at least one Capital letter.";
       }
       if (!preg_match('/[0-9]/', $password)) {
           $errors[] = "Password must contain at least one Number.";
       }
       if (!preg_match('/[!@#$%^&*()]/', $password)) {
           $errors[] = "Password must contain at least one Special Character.";
       }
       if (strpos($password, $username) !== false) {
         $errors[] = "Username and Password are similar";
       }
   }
 if (empty($confirm_password)) {
   $errors[] = "Please confirm your password.";
 } else if ($password !== $confirm_password) {
   $errors[] = "Passwords do not match.";
   
 }

//Implementing Captcha 
       $recaptcha_secret = '6Lcx_yMlAAAAAE-T5qlddOKOVtNM9c6i7TCfQtbU';
       $recaptcha_response = $_POST['g-recaptcha-response'];
       $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
       $recaptcha_data = array(
         'secret' => $recaptcha_secret,
         'response' => $recaptcha_response
       );
       $recaptcha_options = array(
         'http' => array(
           'method' => 'POST',
           'content' => http_build_query($recaptcha_data)
         )
       );
       $recaptcha_context = stream_context_create($recaptcha_options);
       $recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
       $recaptcha_json = json_decode($recaptcha_result);

       if ($recaptcha_json->success) {
       } else {
         $errors[] = "Invalid reCaptcha.";
         
       }
       
 // If no errors, process form submission
 if (empty($errors)) {
    // Setup insert SQL  
      $sql ="INSERT INTO students (firstname, lastname, username, email, password, confirm_password, verification_code, is_verified)
           VALUES ( '$firstname', '$lastname', '$username', '$email', '$password_hash', '$cpassword_hash', '$v_code', '0')";   
       // step 6: run the sql to insert data into database
           if (($connect->query($sql) === TRUE) && sendMail($email, $v_code))
           { //if data inserted successfully
             echo"
             <script>  
              alert('Registration Successfully');
               window.location.href='login.php';
               </script>  
               ";
?>
<?php
           }
           else
           {
            //if data cannot be inserted
             echo"
             <script>  
              alert('Server Down');
               window.location.href='register.php';
               </script>  
               ";
           }
           exit;
   
 }

   if (!empty($errors)) {
       $_SESSION['errors'] = $errors;
       $_SESSION['firstname'] = $firstname;
       $_SESSION['lastname'] = $lastname;
       $_SESSION['username'] = $username;
       $_SESSION['email'] = $email;
       $_SESSION['password'] = $password;
       $_SESSION['confirm_password'] = $confirm_password;
       header('Location: register.php');
       exit;
   }
 }
 

?>