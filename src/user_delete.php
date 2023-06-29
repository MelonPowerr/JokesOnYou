<?php

use src\DataBaseOperations;
require_once ($_SERVER['DOCUMENT_ROOT'].'/src/DataBaseOperations.php');
$host = 'localhost';
$db = 'JokesAside';
$user = 'root';
$password = '';

$dbOperations = new DataBaseOperations($host, $db, $user, $password);
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $dbOperations->deleteUser($user_id);
    session_destroy();

    header("Location: ../login_page.php");
    exit();
} else {
    header("Location: ../login_page.php");
    exit();
}
?>
