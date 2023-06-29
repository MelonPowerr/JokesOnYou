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

$query = $pdo->prepare("SELECT * FROM UserInfo WHERE username = :username");
$query->execute(['username' => $username]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user) {

    if (password_verify($password, $user['password'])) {

        session_start();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: dashboard_page.php");
        exit();
    } else {
        echo "Неверное имя пользователя или пароль.";
    }
} else {
    echo "Неверное имя пользователя или пароль.";
}
?>
