<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylesheet/styles.css">
    <title>Log in</title>
</head>

<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f0f0f0;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: -40px;
  background: radial-gradient(circle at 0% 0.5%, rgb(241, 241, 242) 0.1%, rgb(224, 226, 228) 100.2%);
}

.field {
  position: relative;
  width: 280px;
}

input {
  border: none;
  outline: none;
  width: 100%;
  padding: 5px 0;
}

label {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: #0074d9;
  transition: width 0.3s ease-in-out;
}

input:focus + label {
  width: 100%;
}

</style>

<body>
    <div class="outside-form-container">
        <div class="form-container">
            <div class="DO-logo"><img src="/DisciplinaryOffice/logo/STI_LOGO.svg"></div>
            <div class="login-text"><span>Login</span></div>                           
            <form action="authenticate.php" method="POST">
                <div class="field">
                    <input class="User-input" type="text" placeholder="User ID" maxlength="10" id="user_id" name="user_id" required>
                    <label for="User-ID" class="label-warpper:"> </label>
                </div>
    </br>
                <div class="field">
                    <div style="position: relative;">
                        <input class="Password-input" type="password" placeholder="Password" id="password" name="password" required>
                        <label for="User-ID" class="label-warpper:"> </label>
                        <span style="position: absolute; right: 10px; top: 7px; cursor: pointer;" onclick="togglePasswordVisibility()">
                        <i class="material-icons" style="color: black;">visibility</i>
                      </span>
                    </div>
                </div>
                <div>
                    <button type="submit" class="submit-button ">Sign in</button>
                </div>
                <hr/>
                <div>
                    <a class="forgot-password, fa" href="#" style="color: black; text-decoration: none;">Forgot Account &nbsp; &#xf084;</a>
                </div>
            </form>

            <div class="text-invalid">
            <?php
            if (isset($_GET['error']) && $_GET['error'] === 'InvalidUserOrPassword') {
                echo "Invalid User ID or Password!";
            }
            ?>
            </div>
        </div>
    </div>



    <script>
        function redirectToAdminForm() {
            window.location.href = "#";
        }

        function togglePasswordVisibility() {
            var passwordInput = document.querySelector(".Password-input");
            var eyeIcon = document.querySelector(".material-icons");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.textContent = "visibility_off";
            } else {
                passwordInput.type = "password";
                eyeIcon.textContent = "visibility";
            }
        }

    </script>

<?php
// Place this code at the very end of the PHP file
ob_end_flush(); // Flush the output buffer and send the output to the browser
?>
</body>

</html>