<?php
    define("TITLE", "Registration");
    session_start();
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
    <div class="light-dark">
    <img src="include/moon.svg" id="light-dark" class="light-dark" alt="" width="30px">
    </div>

    <div id="login-container">
    <?php
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $passwd = $_POST['password'];
    $hashed_passwd = password_hash($passwd, PASSWORD_DEFAULT);
    $conf_password = $_POST['conf_password'];
    

    $errors = array();

    if (empty($fullname) || empty($username)|| empty($email) || empty($passwd) || empty($conf_password)) {
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
        $login = "root";
        $password = "root";

        try{
            $conn = new PDO("mysql:host=$serveurname;dbname=login-register", $login, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * from users WHERE username = ?");
            $stmt->execute([$_POST["username"]]);
            
            $user = $stmt->fetch();
            if($user){
                array_push($errors, "Username already exist!!");
                foreach ($errors as $error) {
                    echo "<div class=\"error\">$error</div>";
                }
            }
            else{
                $sql = "INSERT INTO users (fullname, username, email, passwd) VALUES('$fullname', '$username', '$email', '$passwd');";
                $conn->exec($sql);
                $_SESSION['fullname'] = $fullname;
                $_SESSION['email'] = $email;
                header('Location: index.php'); 
                exit();
            }
            
            
        }catch(PDOExeption $e){
            echo "Connection failed". $e->getMessage();
        }finally{
            $conn = null;
        }
        
        }
    }
?>

        <form action="registration.php" method="post" id="form">
            <label for="fullname">Fullname</label>
            <input type="text" name="fullname" class="login-input ">
            <label for="fullname">username</label>
            <input type="text" name="username" class="login-input ">
            <label for="email">email</label>
            <input type="email" name="email" class="login-input ">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="login-input ">
            <label for="conf-password">Confirm password</label>
            <input type="password" name="conf_password" class="login-input ">

            <input  class="login-button" type="submit" value="Submit" name="submit"></button>
            <a href="login.php">Already have a account, log in ?</a>

        </form>
    </div>
    <div class="copyright">
        <?php
            include('/Applications/MAMP/htdocs/login-pages/include/footer.php');
        ?>
    </div>
    <script type="text/javascript" src="script.js"></script>
        
</body>
    
</html>

