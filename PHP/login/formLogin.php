<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&family=VT323&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/Registro.css">
    <link rel="stylesheet" href="../../CSS/Index.css">
    <link rel="icon" type="image/x-icon" href="../../Interfaces Proyecto/Logo.png">
    <title>Log In - ForoGamers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body class="body">
    <div class="form">
        <div class="login-box">
        <form action="" method="post">
            <div class="user-box">
                <label>Username</label>
                <input type="text" name="usernameLogin" value="<?php if (isset($_REQUEST['usernameLogin'])) echo $_POST['usernameLogin']; ?>"/><br>
                <?php
                    echo (isset($errores["NoUserLogin"])) ? "<div class='errorMessage'>$errores[NoUserLogin]</div>": "";
                ?>
                <label>Password</label><br>
                <label class="passLabel">
                    <input type="password" name="passwordLogin" id="password"/>
                    <i class="hide fa fa-eye"></i>
                    <i class="show fa fa-eye-slash"></i>
                </label>
                <?php
                    echo (isset($errores["NoPassLogin"])) ? "<div class='errorMessage'>$errores[NoPassLogin]</div><br>": "";
                ?>
                <a href="checkForgotPass.php" class="forgotPassword">Forgot your password?</a>
                
            </div>
            <input type="submit" class="buttonForm" name="submitLogin" value="Log In"/>
            <div class="messageLogin">Don't have an account? <a href="../register/registro.php">Sign up</a></div>
        </form>
        </div>
    </div>
    <?php
        pie();
    ?>
    <script src="../../JS/index.js"></script>
    <script>
        var passwordField = document.getElementById("password");
        var show = document.querySelector(".show");
        var hide = document.querySelector(".hide");

        show.onclick = function(){
            passwordField.setAttribute("type", "text");
            show.style.display = "none";
            hide.style.display = "block";
        }

        hide.onclick = function(){
            passwordField.setAttribute("type", "password");
            hide.style.display = "none";
            show.style.display = "block";
        }

    </script>
</body>
</html>