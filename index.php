<!DOCTYPE html>
<html lang="ru">
<head>
    <?php use src\DataBaseOperations;
    require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/head_dependencies.php');?>
    <title>Главная - Остров Анеков</title>
    <meta name="description" content="Сайт с анекдотами для больших и маленьких">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/header+nav.php');?>
<main>
    <p id="serious">
        <img src="/images/серьезный.jpg" alt="тут был серьезный" width="300" height="250">
    </p>
    <h2>Самое смешное</h2>
    <div>
        <?php
        require_once ($_SERVER['DOCUMENT_ROOT'].'/src/DataBaseOperations.php');

        $jokesAside = new DataBaseOperations();
        $jokesAside->displayJokes();
        ?>
    </div>
</main>
<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/footer.php');?>

</body>
</html>