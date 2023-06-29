<!DOCTYPE html>
<html lang="ru">
<head>
    <?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/head_dependencies.php');?>
    <title>Случайное - Остров Анеков</title>
    <meta name="description" content="Случайная шутейка для каждого возраста">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/rand_button.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#randomJokeButton').click(function () {
                $.ajax({
                    url: 'src/random_joke.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $('#jokeSection').html(response.text);
                    },
                    error: function () {
                        console.log('Ошибка при выполнении AJAX-запроса');
                    }
                });
            });
        });
    </script>
</head>

<body>
<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/header+nav.php');?>
<main>
    <div>
        <button id="randomJokeButton">Чем повеселишь?</button><br><br>
        <div id="jokeSection"></div>
    </div>
</main>

<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/layouts/footer.php');?>

</body>
</html>