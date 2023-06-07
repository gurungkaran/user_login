<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>
</head>

<body>
    <div class="form-box1" style="padding: 50px 50px 20px 50px">
        <img src="logo.png" alt="Your Logo">
        <h2>Welcome back, you've been missed!</h2>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <form action="processlogin.php" method="POST">

            <div class="wrapper">
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <i class="fa fa-user"></i>
            </div><br>

            <div class="wrapper">
                <input type="password" id="password-field" name="password" placeholder="Password"
                    autocomplete="new-password" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <div class="toggle-password">
                <i class="fa-solid fa-eye"></i>
                <i class="fa-solid fa-eye-slash"></i>
            </div>

            <script type="text/javascript">
            const passwordField = document.getElementById('password-field');
            const togglePassword = document.querySelector('.toggle-password');

            togglePassword.addEventListener('click', function() {
                const eye = this.querySelector('.fa-eye');
                const eyeSlash = this.querySelector('.fa-eye-slash');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eye.style.display = 'inline-block';
                    eyeSlash.style.display = 'none';
                } else {
                    passwordField.type = 'password';
                    eye.style.display = 'none';
                    eyeSlash.style.display = 'inline-block';
                }
            });
            </script>

            <div style="color:red">
                <?php 
		if (isset($_SESSION['login_error'])) {
			echo "<p><b>*</b> {$_SESSION['login_error']}</p>";
			unset($_SESSION['login_error']);
		}
		?>
            </div>
            <input type="submit" name="login" value="Login">
            <br><br>
            <div style="text-align: center;">
                <p style="display: inline-block; margin-top: 10px; margin-bottom: 30px;">Not a member? <a
                        href="register.php" class="register-btn">Register Now</a></p>
            </div>
        </form>
    </div>

</body>

</html>