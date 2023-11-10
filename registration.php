<?php
    define("TITLE", "Registration")
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
    <?php
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $passwd = $_POST['password'];
    $hashed_passwd = password_hash($passwd, PASSWORD_DEFAULT);
    $conf_password = $_POST['conf_password'];
    $id = 1;

    $errors = array();

    if (empty($fullname) || empty($email) || empty($passwd) || empty($conf_password)) {
        array_push($errors, "Tous les champs ne sont pas remplis");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "This email is an invalid email address");
    }
    if (strlen($passwd) < 8) {
        array_push($errors, "The password must have at least 8 characters");
    }
    if ($passwd !== $conf_password) {
        array_push($errors, "The password is not confirmed");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class=\"error\">$error</div>";
        }
    } else {
    
        // Create a connection
        $serveurname = "localhost";
        $username = "root";
        $password = "root";

        try{
            $conn = new PDO("mysql:host=$serveurname;dbname=login-register", $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "INSERT INTO users (fullname, email, passwd) VALUES('$fullname', '$email', '$hashed_passwd');";

            $conn->exec($sql);
            echo "Recorded succefully";
        }catch(PDOExeption $e){
            echo "Connection failed". $e->getMessage();
        }
        $conn = null;
        }
    }
?>

        <form action="registration.php" method="post">
            <label for="fullname">Nom complet</label>
            <input type="text" name="fullname" class="login-input ">
            <label for="email">email</label>
            <input type="email" name="email" class="login-input ">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="login-input ">
            <label for="conf-password">Confirmation de mot de passe</label>
            <input type="password" name="conf_password" class="login-input ">

            <input  class="login-button" type="submit" value="Soumettre" name="submit"></button>
            <a href="login.php">Vous avez deja un compte ?</a>

        </form>
    </div>

    <footer>
    <?php
            $myname = "Mohamed Wade";
            $thisYear = date('Y');
            echo "$myname &copy $thisYear";
        ?>
    </footer>
        
</body>
    
    <script type="text/javascript" src="scripts.js"></script>
</html>

