<?php
    session_start();
    define("TITLE", "Welcome Back");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-log.css">
    <title><?php echo TITLE; ?></title>
</head>
<body>
    
    <ul>
        <li><a href="default.asp">Home</a></li>
        <li><a href="news.asp">News</a></li>
        <li><a href="contact.asp">Review my personnal infos</a></li>
        <li><a href="login.php" <?php session_destroy() ;?>>Disconnection</a></li>
</ul>
    <main>
        
        <!-- Welcome Section -->
            <div class="login-container">
                <h2>Welcome </h2>
            </div>

            <div class="copyright">
                <?php
                include('/Applications/MAMP/htdocs/login-pages/include/footer.php');
                ?>
            </div>
</main>
</body>
</html>