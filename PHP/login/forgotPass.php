<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Registro.css">
    <link rel="stylesheet" href="../../CSS/Index.css">
    <title>Account Recovery</title>
</head>
<body class="body">
    <?php
        cabecera();
    ?>
    <div class="form">
        <form action="" method="post">
            <label>Email</label><br>
            <input type="text" name="emailForgot"/>
            <br>
            <?php
                echo (isset($errores["emailForgot"])) ? "<div class='errorMessage'>$errores[emailForgot]</div>" : "";
            ?>
            <div class="messageLogin">Enter your email address.</div><br>
            <input type="submit" class="buttonForm" name="submitForgot" value="Send recovery mail"/>
        </form>
    </div>
    <?php
        pie();
    ?>
</body>
</html>