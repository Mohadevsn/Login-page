<?php
define("TITLE", "Login");
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
    <div class="nav-bar">
        <img src="" id="light-dark" alt="">
    </div>
    <div class="login-container">
        <?php
        if (isset($_POST['submit'])) {
            $username = $_POST["username"];
            $passwd = $_POST["password"];

            $errors = array();
            if (empty($username) || empty($passwd)) {
                array_push($errors, "Tout le champ ne sont pas remplis");
            }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class=\"error\">$error</div>";
                }
            } else {
                $serveurname = "localhost";
                $login = "root";
                $password = "root";

                try {
                    // Create connection
                    $conn = new PDO("mysql:host=$serveurname;dbname=login-register", $login, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("SELECT * from users WHERE username = ? AND passwd = ?");
                    $stmt->execute([$username, $passwd]);

                    $user = $stmt->fetch();

                    if ($user) {
                        header('Location: index.php');
                        exit(); // Make sure to exit after a header redirect
                    } else {
                        echo "<div class=\"error\">Username or password is incorrect!</div>";
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                } finally {
                    $conn = null;
                }
            }
        }
        ?>

        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" class="login-input">
            <label for="password">Password</label>
            <input type="password" name="password" class="login-input">
            <button class="login-button" type="submit" value="Soumettre" name="submit">Connection</button>
            <a href="registration.php">Create a new account</a>
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
