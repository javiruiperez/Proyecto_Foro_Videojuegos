<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <title>Forgot password? - PokéBuilding</title>
</head>
<body>
<header>
        <div class="header-options">
            <div class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <div class="icon-text">PokéBuilding</div>
            </div>
        </div>
        <div class="header-login">
            <div class="sign-in"><a href="checkLogin.php">Sign in</a></div>
            <div class="sign-up"><a href="checkRegister.php">Sign up</a></div>
        </div>
    </header>
    
    <div class="main-content">
        <?php 
            if(isset($_SESSION["status"])) {
                ?>
                <div class="alert-message">
                    <h5><?php echo $_SESSION["status"] ?></h5>
                </div>
                <?php
                unset($_SESSION["status"]);
            }
        ?>
        <div class="form-forgot">
            <form action="" method="post">
                <input type="password" class="new-password" name="new-password-1" placeholder="New password">
                <input type="password" class="new-password" name="new-password-2" placeholder="Confirm password">

                <input type="submit" class="submit-button" name="password-button" value="Reset password">
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-options">
            <div class="terms-conditions"><a href="terms_conditions.php">PRIVACY POLICY</a></div>
            <div class="about-us"><a href="about_us.php">ABOUT US</a></div>
        </div>

        <div class="social-media">
            <div class="youtube">
                <a href="youtube.com">YOUTUBE</a>
            </div>
            <div class="twitter">
                <a href="twitter.com">TWITTER</a>
            </div>
            <div class="instagram">
                <a href="instagram.com">INSTAGRAM</a>
            </div>
        </div>
    </footer>
</body>
</html>