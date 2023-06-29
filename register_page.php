<?php
use src\DataBaseOperations;
require_once ($_SERVER['DOCUMENT_ROOT'].'/src/DataBaseOperations.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dbOperations = new DataBaseOperations();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $description = $_POST['description'];

    // Вызов метода регистрации
    $dbOperations->registerUser($username, $password, $description);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/head_dependencies.php');?>
    <title>Регистрация - Остров Анеков</title>
    <meta name="description" content="Регистрация пользователя">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/header+nav.php');?>

<main>
    <form method="post" action="">
        <input type="text" name="username" id="username" placeholder="Имя пользователя" required><br>
        <input type="password" name="password" id="password" placeholder="Пароль" required><br>
        <textarea name="description" id="description" placeholder="Пару слов о себе"></textarea><br>
        <input type="submit" value="Зарегистрироваться"><br>
        <a href="login_page.php">Уже смешарик?</a>
    </form>
</main>

<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/footer.php');?>

</body>
</html>
