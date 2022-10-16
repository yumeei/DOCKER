<?php
session_start();
$pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
if (isset($_POST['connexion'])) {
    if (!empty($_POST['username']) and !empty($_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = md5($_POST['password']);
        // get users from db
        $getUser = $pdo->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
        // get user with matching username and password
        $getUser->execute(array($username, $password));
        if ($getUser->rowCount() > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $getUser->fetch()['id'];
            header('Location: post.php');
        } else {
            echo "Incorrect username or password.";
        }
    } else {
        echo "Please fill all of the fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Docker PHP</title>
</head>
<body>
    <!-- sign up form -->
    <section class="login-form">
        <h1>Log in</h1>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" autocomplete="off">
            <input type="password" name="password" placeholder="Password" autocomplete="off">
            <input type="submit" name="connexion" value="Login">
        </form>
        <label>Don't have an account?</label>
        <a href="signup.php">Create one here</a>
    </section>
</body>
</html>