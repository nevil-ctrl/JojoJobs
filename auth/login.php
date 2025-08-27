<?php 
session_start();
require_once __DIR__ . '/../config/db.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($login === '' || $email === '' || $password === '') {
        $_SESSION['errors'] = "Заполни все поля а!";
    } 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'] = "Некорректный email!";
    }
     if (strlen($password) < 4) {
        $_SESSION['errors'] = "Пароль должен быть не менее 4 символов!";
    } 




    if (empty($_SESSION['error'])) {
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE login = ? OR email = ?");
            $stmt->execute([$login, $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user === false || !password_verify($password, $user['password'])) {
                $_SESSION['errors'] = "Неверный логин или пароль!";
            } else {
                $_SESSION['user'] = $user;
                header("Location: /");
                exit();
            }
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }
}
        

       
?>
<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $msg) echo "<li>$msg</li>"; ?>
    </ul>
<?php endif; ?>

<form class="register-form" method="post" action="">
    <h2>Регистрация</h2>
    <label for="login">Имя
        <input id="login" name="login" type="text" placeholder="Введите логин" required>
    </label>
    <label for="email">Почта
        <input id="email" name="email" type="email" placeholder="Введите почту" required>
    </label>
    <label for="password">Пароль
        <input id="password" name="password" type="password" placeholder="Введите пароль" required>
        <!-- <img src="" alt=""> -->
    </label>
    <button type="submit">Войти</button>
</form>