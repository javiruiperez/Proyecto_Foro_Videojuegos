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
    <title>Account Recovery - ForoGamers</title>
</head>
<body class="body">
    <?php
        cabecera();
    ?>
    <div class="form">
    <div class="forgot-box">
        <form action="" method="post">
            <div class="user-box">
                <label>Email</label><br>
                <input type="text" name="emailForgot"/>
                <br>
                <?php
                    echo (isset($errores["emailForgot"])) ? "<div class='errorMessage'>$errores[emailForgot]</div>" : "";
                ?>
                <div class="messageLogin">Enter your email address.</div><br>
            </div>
            <input type="submit" class="buttonForm" name="submitForgot" value="Send recovery mail"/>
          </div>
        </form>
    </div>
    <?php
        pie();
    ?>
    <script src="../../CSS/Index.css"></script>
</body>
</html>