<?php 
session_start();
require_once __DIR__ . '/../config/db.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($login === '' || $email === '' || $password === '') {
        $errors[] = "Заполни все поля!";
    } 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Некорректный email!";
    }
    if (strlen($password) < 4) {
        $errors[] = "Пароль должен быть не менее 4 символов!";
    } 

    if (empty($errors)) {
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE login = ? OR email = ?");
            $stmt->execute([$login, $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($password, $user['password'])) {
                $errors[] = "Неверный логин или пароль!";
            } else {
                $_SESSION['user'] = $user;
                header("Location: /");
                exit(); 
            }
        } catch (PDOException $e) {
            $errors[] = "Иди в жопу это Ошибка: " . $e->getMessage();
        }
    }
}
?> 

<?php if (!empty($errors)): ?>
    <ul class="login-errors">
        <?php foreach ($errors as $msg): ?>
            <li><?= htmlspecialchars($msg) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php $titleName = 'Вход'?>

<form method="post">
    <label for="login">Имя
        <input id="login" 
        name="login" 
        type="text" 
        placeholder="Введите логин" required>
    </label>
    <label for="email">Почта
        <input id="email" 
        name="email" 
        type="email" 
        placeholder="Введите почту" required>
    </label>
    <label for="password">Пароль
        <input id="password" 
        name="password" 
        type="password" 
        placeholder="Введите пароль" required autocomplete="current-password">
    </label>
    <button type="submit">Войти</button>
</form>
