<?php

namespace src;

use PDO;
use PDOException;
class DataBaseOperations {
    private $pdo;

    public function __construct($host = 'localhost', $db= 'JokesAside', $user= 'root', $password= '', $charset = 'utf8') {
        try {
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $this->pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    public function displayJokes() {
        try {
            $query = $this->pdo->query('SELECT * FROM Jokes');

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='main_jokes'>" . $row['text'] . "<br><br>" . "</div>";
            }
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }

    public function getRandomJoke() {
        try {
            $query = $this->pdo->query('SELECT text FROM Jokes ORDER BY RAND() LIMIT 1');
            $joke = $query->fetch(PDO::FETCH_ASSOC);
            return $joke;
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }

    public function loginUser($username, $password) {
        try {
            $query = $this->pdo->prepare("SELECT * FROM UserInfo WHERE username = :username");
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
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }

    public function registerUser($username, $password, $description) {
        try {
            $query = $this->pdo->prepare("SELECT * FROM UserInfo WHERE username = :username");
            $query->execute(['username' => $username]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "Пользователь с таким именем уже существует.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $insertQuery = $this->pdo->prepare("INSERT INTO UserInfo (username, password, description) VALUES (:username, :password, :description)");
                $insertQuery->execute(['username' => $username, 'password' => $hashedPassword, 'description' => $description]);
                header("Location: login_page.php");
                exit();
            }
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }
    public function deleteUser($user_id) {
        try {
            $sql = "DELETE FROM UserInfo WHERE id = :user_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Пользователь успешно удален.";
            } else {
                echo "Ошибка при удалении пользователя.";
            }
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }
    public function submitJoke($username, $tag, $text) {
        try {
            $query = $this->pdo->prepare("INSERT INTO Jokes (author, tag, text) VALUES (:author, :tag, :text)");
            $query->execute(['author' => $username, 'tag' => $tag, 'text' => $text]);
            echo "Анекдот успешно отправлен.";
        } catch (PDOException $e) {
            echo "Ошибка при отправке анекдота: " . $e->getMessage();
        }
    }
    public function displayUserJokes($sortOption = 'id')
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $sortColumn = ($sortOption === 'tag') ? 'Jokes.tag' : 'Jokes.id';

            $query = $this->pdo->prepare("SELECT Jokes.tag, Jokes.text
                                      FROM Jokes
                                      JOIN UserInfo ON Jokes.author = UserInfo.username
                                      WHERE UserInfo.id = :user_id
                                      ORDER BY $sortColumn");
            $query->execute(['user_id' => $user_id]);

            echo "<div class='jokes-container'>";

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='joke'>";
                echo "<div class='tag'>" . $row['tag'] . "</div>";
                echo "<div class='text'>" . $row['text'] . "</div>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "Пользователь не авторизован.";
        }
    }

}

?>


