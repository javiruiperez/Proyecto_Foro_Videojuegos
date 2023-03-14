<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <title>Home - PokeBuilding</title>
</head>
<body>
    <!-- HEADER (NIGHT MODE ICON) -->
    <header>
        <button class="night-mode-button" onclick="toggleDarkMode()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/></svg>
        </button>
        <?php
            session_start();
            if(!isset($_SESSION["user"])){
        ?>
            <a href="checkLogin.php" class="profile-picture"><img src="../img/default-pfp.png" alt="no-login"></a>
        <?php
            } else{
        ?>
            <a href="profile.php" class="profile-picture"><img src="<?php echo "../img/".$_SESSION["user"]."/imgage.png" ?>" alt="profile-picture"></a>
        <?php
            }
        ?>
    </header>

    <!-- BODY -->
    <div class="main-content">
        <div class="home-tittle">PokéBuilding</div>
        <div class="home-text">A cool website to create your own teams and compare them with other!<br> Create an account or login to get started.</div>
        <div class="home-options">
            <?php
                if(!isset($_SESSION["user"])){
            ?>
            <div class="home-login">
                <a href="checkLogin.php">LOGIN</a>
            </div>
            <div class="home-register">
                <a href="checkRegister.php">REGISTER <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></a>
            </div>
            <?php 
                } else{
            ?>
            <div class="home-teams"><a href="createTeams.php">CREATE TEAM</a></div>
            <?php
                }
            ?>
        </div>
    </div>

    <!-- FOOTER -->
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