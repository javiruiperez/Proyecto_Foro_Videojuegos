<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Recovery</title>
</head>
<body>
    <div class="form">
        <div>Forgot your account's password or having trouble logging into your Team? Enter your email address and we'll send you a recovery link.</div>
        <form action="" method="post" class="formLogin">
            <label>Email</label>
            <input type="text" name="emailForgot"/>
            <?php
                echo (isset($errores["emailForgot"])) ? "$errores[emailForgot]" : "";
            ?>
            <input type="submit" class="buttonForm" name="submitForgot" value="Send recovery mail"/>
    </div>
</body>
</html>