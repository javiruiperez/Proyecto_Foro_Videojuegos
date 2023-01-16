<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <!--HEADER FIJO-->
    <div class="form">
        <form action="" method="post" class="formLogin">
            <label>Username</label>
            <input type="text" name="usernameLogin"/>
            <?php
                echo (isset($errores["NoUserLogin"])) ? "$errores[NoUserLogin]": "";
            ?>
            <label>Password</label>
            <input type="password" name="passwordLogin"/>
            <a href="checkForgotPass.php" class="forgorPassword">Forgot your password?</a>
            <?php
                echo (isset($errores["NoPassLogin"])) ? "$errores[NoPassLogin]": "";
            ?>
            <input type="submit" class="buttonForm" name="submitLogin" value="Log In"/>
        </form>
    </div>
    <div class="signinLogin">Don't have an account? <a href="registro.php">Sign up</a></div>
</body>
</html>