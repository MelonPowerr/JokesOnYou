<?php

use src\DataBaseOperations;

session_start();

if (isset($_SESSION['user_id'])) {
} else {
    header("Location: login_page.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/head_dependencies.php');?>
    <title>Личное - Остров Анеков</title>
    <meta name="description" content="Личный уголок пользователя">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dash_style.css">
    <link rel="stylesheet" href="css/sort_buttons.css">
</head>

<body>
<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/header+nav.php');?>

<main>
    <div id="id1">
        <a href="submit_page.php" id="addJokeButton">Добавить шутку</a><br>
        <a href="src/logout.php">Выход</a><br>
        <a href="src/user_delete.php">Удалиться</a><br>
    </div>
    <h2>История ваших анеков</h2>
    <div id="id2">
        <div class="sort-options">
            <p>Сортировать по:</p>
            <a href="?sort=id">ID</a>
            <a href="?sort=tag">Тегу</a>
        </div>
        <?php
        require_once ($_SERVER['DOCUMENT_ROOT'].'/src/DataBaseOperations.php');

        $jokesAside = new DataBaseOperations();

        // Проверяем, существует ли параметр 'sort' в строке запроса
        if (isset($_GET['sort'])) {
            $sortOption = $_GET['sort'];
            $jokesAside->displayUserJokes($sortOption);
        } else {
            // По умолчанию сортировка по id
            $jokesAside->displayUserJokes();
        }
        ?>
    </div>


</main>

<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/footer.php');?>

</body>
</html>