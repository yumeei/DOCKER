<?php
session_start();

$pdo = new PDO("mysql:host=database;dbname=data", "root", "password");

if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
    if (isset($_POST['validate'])) {
        if (isset($_POST['content']) and !empty($_POST['content'])) {
            $username = htmlspecialchars($_SESSION['username']);
            $content = htmlspecialchars($_POST['content']);

            $user_id = $pdo->prepare('SELECT id FROM user WHERE username = ?');
            $user_id->execute(array($username));
            $user_id = $user_id->fetch();
            $user_id = $user_id['id'];
            $ins = $pdo->prepare('INSERT INTO post(user_id, content) VALUES (?,?)');
            $ins->execute(array($_SESSION['id'], $content));

            $error = "Message sent successfully";
        } else {
            $error = "Please fill all the fields";
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <?php 
        $pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
        $getContent = $pdo->query('SELECT * FROM post, user');
        ?>
        <h1>Hello, <?= $_SESSION['username']; ?> !</h1>
        <a href="logout.php">Log out</a>
        <form method="POST" action="">
            <textarea name="content"></textarea>
            <input type="submit" name="validate">
            <?php if (isset($error)) {
                echo $error;
            } ?>
        </form>
        <?php
        while ($content = $getContent->fetch()) {
        ?>
            <h4>Message from <?= $content['username']; ?></h4>
            <p><?= $content['content']; ?></p>
        <?php
        }
        ?>

    </body>

    </html>

<?php } ?>