<?php

use src\DataBaseOperations;

session_start();

require_once ($_SERVER['DOCUMENT_ROOT'].'/src/DataBaseOperations.php');

$jokesAside = new DataBaseOperations();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tag = $_POST['tag'];
    $text = $_POST['text'];

    // Получение имени пользователя из сессии
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

    $jokesAside->submitJoke($username, $tag, $text);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/head_dependencies.php');?>
    <title>Отправка анека - Остров Анеков</title>
    <meta name="description" content="На данной странице пользователь может отправить свою любимую шутку в нашу редакцию">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/header+nav.php');?>

<main>
    <div>
        <form method="post" action="">
            <input type="text" name="tag" placeholder="Тег анекдота" required><br>
            <textarea name="text" placeholder="Текст анекдота" required></textarea><br>

            <input type="submit" value="Отправить анекдот">
        </form>
    </div>
</main>
<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/footer.php');?>
</body>
</html>
