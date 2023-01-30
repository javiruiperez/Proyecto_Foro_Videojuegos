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
    <title>Log In</title>
</head>
<body>
    <div class="form">
        <div class="login-box">
        <form action="" method="post">
            <div class="user-box">
            <label>Username</label>
            <input type="text" name="usernameLogin" value="<?php if (isset($_REQUEST['usernameLogin'])) echo $_POST['usernameLogin']; ?>"/><br>
            <?php
                echo (isset($errores["NoUserLogin"])) ? "<div class='errorMessage'>$errores[NoUserLogin]</div>": "";
            ?>
            
            </div>
            <div class="user-box">
            <label>Password</label>
            <input type="password" name="passwordLogin"/>
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
</body>
</html>