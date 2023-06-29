<?php
//$user = 'root'; // пользователь
//$password = ''; // пароль
//$db = 'JokesAside'; // название бд
//$host = 'localhost'; // хост
//$charset = 'utf8'; // кодировка
//
//try {
//    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $password);
//
//    $query = $pdo->query('SELECT text FROM Jokes ORDER BY RAND() LIMIT 1');
//    $joke = $query->fetch(PDO::FETCH_ASSOC);
//
//    header('Content-Type: application/json');
//    echo json_encode($joke);
//} catch (PDOException $e) {
//    echo "Ошибка: " . $e->getMessage();
//}
//?>
<?php use src\DataBaseOperations;

require_once ($_SERVER['DOCUMENT_ROOT'].'/src/DataBaseOperations.php');

$dataBaseOperations = new DataBaseOperations();

$joke = $dataBaseOperations->getRandomJoke();
header('Content-Type: application/json');
echo json_encode($joke);
?>
