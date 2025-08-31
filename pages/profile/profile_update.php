<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

if (empty($_SESSION['user']['id'])) {
    header('Location: /');
    exit;
}

$id = $_SESSION['user']['id'];
$login = trim($_POST['login'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$repeatpass = $_POST['repeatpass'] ?? '';

if (!empty($password) && $password !== $repeatpass) {
    die('Пароли не совпадают!');
}

try {
    if (!empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET login = :login, email = :email, password = :password WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'login' => $login,
            'email' => $email,
            'password' => $passwordHash,
            'id' => $id
        ]);
        $_SESSION['user']['password'] = $passwordHash;
    } else {
        $sql = "UPDATE users SET login = :login, email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'login' => $login,
            'email' => $email,
            'id' => $id
        ]);
    }

    $_SESSION['user']['login'] = $login;
    $_SESSION['user']['email'] = $email;

    header('Location: /profileUpdate');
    exit;
} catch (PDOException $e) {
    die('Ошибка базы данных: ' . $e->getMessage());
}
