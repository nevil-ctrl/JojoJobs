<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

// Проверка авторизации
if (empty($_SESSION['user']['id'])) {
    header('Location: /login'); // Если не авторизован, редирект на логин
    exit;
}

$titleName = 'Профиль';

// Получаем текущие данные пользователя
$id = $_SESSION['user']['id'];
$login = $_SESSION['user']['login'] ?? '';
$email = $_SESSION['user']['email'] ?? '';
$error = '';
$success = '';
$user = $_SESSION['user'] ?? null;
// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newLogin = trim($_POST['login'] ?? '');
    $newEmail = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $repeatpass = $_POST['repeatpass'] ?? '';

    if (!empty($password) && $password !== $repeatpass) {
        $error = 'Пароли не совпадают!';
    } else {
        try {
            $params = ['id' => $id];
            $sql = "UPDATE users SET ";
            $updates = [];

            if (!empty($newLogin)) {
                $updates[] = "login = :login";
                $params['login'] = $newLogin;
            }

            if (!empty($newEmail)) {
                $updates[] = "email = :email";
                $params['email'] = $newEmail;
            }

            if (!empty($password)) {
                $updates[] = "password = :password";
                $params['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            if (!empty($updates)) {
                $sql .= implode(', ', $updates) . " WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute($params);

                // Обновляем сессию
                if (!empty($newLogin)) $_SESSION['user']['login'] = $newLogin;
                if (!empty($newEmail)) $_SESSION['user']['email'] = $newEmail;
                if (!empty($password)) $_SESSION['user']['password'] = $params['password'];

                $success = 'Профиль успешно обновлён!';
                $login = $_SESSION['user']['login'];
                $email = $_SESSION['user']['email'];
            } else {
                $error = 'Нет данных для обновления';
            }
        } catch (PDOException $e) {
            $error = 'Ошибка базы данных: ' . $e->getMessage();
        }
    }
}

require_once "./layout/header.php";
require_once "./layout/nav.php";
?>

<div class="profile-container">
    <h1>Привет, <?= htmlspecialchars($login) ?></h1>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="profile-form">
        <label>Логин</label>
        <input type="text" name="login" value="<?= htmlspecialchars($login) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

        <label>Пароль</label>
        <input type="password" name="password">

        <label>Подтвердите пароль</label>
        <input type="password" name="repeatpass">

        <input type="submit" value="Обновить">
    </form>
</div>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f0f2f5;
    margin: 0;
    padding: 0;
}

.profile-container {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px 30px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.profile-container h1 {
    text-align: center;
    margin-bottom: 25px;
}

.profile-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.profile-form input[type="text"],
.profile-form input[type="email"],
.profile-form input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 14px;
}

.profile-form input[type="submit"] {
    width: 100%;
    padding: 12px;
    background: #007BFF;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.profile-form input[type="submit"]:hover {
    background: #0056b3;
}

.error {
    background: #ffdddd;
    color: #d8000c;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}

.success {
    background: #ddffdd;
    color: #270;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}
</style>
