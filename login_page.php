<?php
use src\DataBaseOperations;
require_once ($_SERVER['DOCUMENT_ROOT'].'/src/DataBaseOperations.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $dbOperations = new DataBaseOperations();

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Вызов метода входа в систему
    $loggedIn = $dbOperations->loginUser($username, $password);

    if ($loggedIn) {

        header("Location: dashboard_page.php");
        exit();
    } else {

        echo "Неверное имя пользователя или пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/head_dependencies.php');?>
    <title>Вход - Остров Анеков</title>
    <meta name="description" content="Принятие пользователя в его личные владения">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/header+nav.php');?>

<main>
    <form method="post" action="">
        <input type="text" name="username" id="username" placeholder="Имя пользователя" required><br>
        <input type="password" name="password" id="password" placeholder="Пароль" required><br>
        <input type="submit" value="Войти"><br>
        <a href="register_page.php">Еще не смешарик?</a>
    </form>
</main>

<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/footer.php');?>

</body>
</html>
