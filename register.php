<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#password").on("keyup", function() {
            var password = $(this).val();
            var strength = 0;

            if (password.length >= 8) {
                strength += 1;
            }
            if (password.match(/([a-z])/)) {
                strength += 1;
            }
            if (password.match(/([A-Z])/)) {
                strength += 1;
            }
            if (password.match(/([0-9])/)) {
                strength += 1;
            }
            if (password.match(/([!@#$%^&*()])/)) {
                strength += 1;
            }
            if (strength == 1) {
                $("#password_strength").html("Your password is very weak!!");
                $("#password_strength").css("color", "darkred");
            } else if (strength == 2) {
                $("#password_strength").html("Your password is weak!");
                $("#password_strength").css("color", "red");
            } else if (strength == 3) {
                $("#password_strength").html("Your password is moderate");
                $("#password_strength").css("color", "orange");
            } else if (strength == 4) {
                $("#password_strength").html("Your password is strong");
                $("#password_strength").css("color", "green");
            } else if (strength == 5) {
                $("#password_strength").html("Your password is more strong");
                $("#password_strength").css("color", "darkgreen");
            } else {
                $("#password_strength").html("");
            }
        });
        $("#confirm_password").on("keyup", function() {
            if ($(this).val() == $("#password").val()) {
                $("#password_match").html("Both password match correctly");
                $("#password_match").css("color", "green");
            } else {
                $("#password_match").html("Passwords do not match");
                $("#password_match").css("color", "red");
            }
        });
    });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <?php
	    $firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
		$lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';
		$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
		$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
		$password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
		$confirm_password = isset($_SESSION['confirm_password']) ? $_SESSION['confirm_password'] : '';
	?>

    <div class="form-box" style="padding: 50px 50px 30px 50px">
        <img src="logo.png" alt="Your Logo">
        <h2>Let's create an account for you!</h2>
        <link rel="stylesheet" type="text/css" href="style.css">
        <form action="processregister.php" method="POST">

            <input type="text" id="firstname" name="firstname" placeholder="Enter your firstname"
                autocomplete="new-password" value="<?php echo "$firstname"?>" required><br><br>

            <input type="text" id="lastname" name="lastname" placeholder="Enter your lastname"
                autocomplete="new-password" value="<?php echo "$lastname"?>" required><br><br>

            <input type="text" id="username" name="username" placeholder="Username" autocomplete="new-password"
                value="<?php echo "$username"?>" required><br><br>

            <input type="email" id="email" name="email" placeholder="E-mail (example@gmail.com)"
                autocomplete="new-password" value="<?php echo "$email"?>" required><br><br>

            <input type="password" id="password" name="password" placeholder="Password" autocomplete="new-password"
                value="<?php echo "$password"?>" required>
            <p class="emphasis">Use 8 or more characters with uppercase & lowercase letters, numbers and special
                characters.</p>
            <span id="password_strength"></span>

            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password"
                autocomplete="new-password" value="<?php echo "$confirm_password"?>" required>
            <span id="password_match"></span>

            <div style="color:red">
                <?php
				if (isset($_SESSION['errors'])) {
				foreach ($_SESSION['errors'] as $error) {
					echo "<p><b>*</b>  $error</p>";
				}
				unset($_SESSION['errors']);
				unset($_SESSION['firstname']);
				unset($_SESSION['lastname']);
				unset($_SESSION['username']);
				unset($_SESSION['email']);
				unset($_SESSION['password']);
				unset($_SESSION['confirm_password']);
				}
			?>
            </div>

            <div class="g-recaptcha" data-sitekey="6Lcx_yMlAAAAAE0evIX_vl4NNHPGZS95324bnDR8"></div>
            <input type="submit" value="Register">
        </form>
    </div>
</body>

</html>