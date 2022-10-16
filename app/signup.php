<?php
session_start();
$pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
// to sign up
if (isset($_POST['inscription'])) {
    if (!empty($_POST['lastname']) and !empty($_POST['firstname']) and !empty($_POST['username']) and !empty($_POST['password'])) {
        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $username = htmlspecialchars($_POST['username']);
        $password = md5($_POST['password']);
        // insert user's info in db
        $insertUser = $pdo->prepare('INSERT INTO user (lastname, firstname, username, password) VALUES(?,?,?,?)');
        $insertUser->execute(array($lastname, $firstname, $username, $password));

        /// get user's info from db
        $getUser = $pdo->prepare('SELECT * FROM user WHERE username = ? AND password =?');
        $getUser->execute(array($username, $password));

        //        crée une session pour chaque utilisateur connecter en récupérant les informations name, password et en passant recuperer l'id avec la commande $getUser
        //        rowcount va compter le nombre de donner trouver pour chercher l'utilisateur et declarer les sessions
        if ($getUser->rowCount() > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $getUser->fetch()['id'];
            // ce fetch permet de juste recuperer l'id
            echo 'Signing up successful, back to <a href="index.php">log in page</a>';
        }
    } else {
        echo "<script>alert(\"Please fill all the fields\")</script>";
    }
}
?>

<h1>Sign up</h1>
<form method="POST" action="">
    <input type="text" name="lastname" placeholder="Last name" autocomplete="off">
    <input type="text" name="firstname" placeholder="First name" autocomplete="off">
    <input type="text" name="username" placeholder="Username" autocomplete="off">
    <input type="password" name="password" placeholder="Password" autocomplete="off">
    <input type="submit" name="inscription" value="Sign up">
    
</form>