<?php 
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $repeatpass = trim($_POST['repeatpass']);

    if (empty($login) || empty($email) || empty($password)) {
        echo "Заполните все поля";
    } elseif ($password !== $repeatpass) {
        echo "Пароли не совпадают";
    }elseif
        (strlen($password) < 4) {
        echo "Пароль должен быть не менее 4 символов!";
    }else {
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE login = ? OR email = ?");
            $stmt->execute([$login, $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "Такой логин или email уже зарегистрированы";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO users (login, password, email) VALUES (?, ?, ?)");
                if ($stmt->execute([$login, $hashedPassword, $email])) {
                    $_SESSION['user'] = $user;
                header("Location: /");
                exit(); 
                    
                } else {
                    echo "Ошибка при регистрации";
                }
            }
        } catch (PDOException $e) {
            echo "Ошибка" . $e->getMessage();
        }
    }
}

?>

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
    </label>
    <label for="repeat">Повтор
        <input id="repeat" name="repeatpass" type="password" placeholder="Повторите пароль" required>
    </label>
    <button type="submit">Зарегистрироваться</button>
</form>
