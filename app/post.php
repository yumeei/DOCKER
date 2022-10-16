<?php
session_start();
$pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
if (isset($_POST['valider'])){
    if(!empty($_POST['content'])){
//        faire en sorte que le username soit celui lors de la creation
        $username = htmlspecialchars($_SESSION['username']);
        $content= nl2br(htmlspecialchars($_POST['content']));

        $inserercontent= $pdo->prepare('INSERT INTO post (username, content) VALUES(?, ?)');
        $inserercontent->execute(array($username, $content));
    }else{
        echo "veuillez compléter tous les champs";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta username="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instant messages</title>
</head>
<body>
    <h1>Hello, user</h1>
<a href="logout.php">Log out</a>

<form method="POST" action="">
    <textarea name="content"></textarea>
    <input type="submit" name="validate">
</form>
<section id="content">
    <?php
    $pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
    $recupcontent= $pdo->query('SELECT * FROM post');
    while($content = $recupcontent->fetch()){
        ?>
            <h4><?= $content['username']; ?></h4>
            <p><?= $content['content']; ?></p>
        <?php
    }
    ?>
</section>



</body>
</html>