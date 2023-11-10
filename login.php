<?php
    define("TITLE", "Login")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-log.css">
    <title><?php echo TITLE;?></title>
</head>
<body>
    <div class="login-container">
        <form action="loginxs.php" method="post">
            <label for="email">email</label>
            <input type="email" name="email" class="login-input ">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" class="login-input ">
            <button  class="login-button" type="submit">Se connecter</button>
            <a href="registration.php">Creer un nouveau compte</a>

        </form>
    </div>
    
</body>
</html>

