<?php
$host = 'localhost';
$db = 'JokesAside';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}


$username = $_POST['username'];
$password = $_POST['password'];
$description = $_POST['description'];


$query = $pdo->prepare("SELECT * FROM UserInfo WHERE username = :username");
$query->execute(['username' => $username]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "Пользователь с таким именем уже существует.";
} else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insertQuery = $pdo->prepare("INSERT INTO UserInfo (username, password, description) VALUES (:username, :password, :description)");
    $insertQuery->execute(['username' => $username, 'password' => $hashedPassword, 'description' => $description]);
    header("Location: login_page.php");
    exit();
}
?>
