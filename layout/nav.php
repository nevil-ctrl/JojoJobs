<?php
require_once __DIR__ . '/../config/db.php';

$userAvatar = 'default.png'; // по умолчанию

if (!empty($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];

    $stmt = $conn->prepare("SELECT avatar FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $avatar = $stmt->fetchColumn();

    if ($avatar) {
        $userAvatar = $avatar;
    }
}
?>

<nav class="nav container">
    <div class="logo"><a href="/">JojoJobs</a> </div>

    <div class="nav-links">
        <div><a href="/jobs">Вакансии</a></div>
        <div><a href="/companies">Компании</a></div>
        <div><a href="/resume">Резюме</a></div>
        <div><a href="/blog">О нас</a></div>
    </div>

    <div class="nav_profile">
        <?php if (isset($_SESSION['user'])): ?>
            <div class="profile_nav_avatar">
                <div onclick="profileDrop()" class="avatar"> <img src="/uploads/avatars/<?= htmlspecialchars($userAvatar) ?>?<?= time() ?>" alt="Аватар" class="image"></div>
                <ul id="dropdown_profile" class="dropdown_profile">
                    <li><a href="/profile">Профиль</a></li>
                    <li><a href="/logout">Выйти</a></li>
                    <li><a href="/settings">Настройки</a></li>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] === 1): ?>
                        <li><a href="/admin">Админ панель</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        <?php else: ?>
      <div class="auth-buttons">
            <a href="/login" class="btn-login">Войти</a>
            <a href="/registr" class="btn-register">Регистрация</a>
            </div>
        <?php endif; ?>
    </div>
</nav>

<style>
.profile_nav_avatar{
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
}
.dropdown_profile {
    background: #fff;
    border-radius: 5px;
    padding: 5px;
    margin: 0;  
    box-shadow: 0 2px 3px #9e9797ff;
    flex-direction: column;
    cursor: pointer;
    display: none; 
    position: absolute;
    top: 90px; 
}
.hidden { display: block; } 

.dropdown_profile li{
    padding: 5px;
}
.image{
    height: 60px;
    width: 60px;
    border-radius: 50%;
}
.container {
max-width: 1200px;
margin: 0 auto;
display: flex;
justify-content: space-between;
align-items: center;
padding: 20px;
}
.logo {
font-size: 1.8rem;
font-weight: 800;
background: linear-gradient(135deg, #667eea, #764ba2);
-webkit-text-fill-color: transparent;
background-clip: text;
}
.nav-links {
display: flex;
list-style: none;
gap: 2rem;
}
.nav-links a {
text-decoration: none;
color: #4b5563;
font-weight: 500;
transition: color 0.3s ease;
position: relative;
}
.nav-links a:hover {
color: #667eea;
}
.nav-links a::after {
content: '';
position: absolute;
width: 0;
height: 2px;
bottom: -5px;
left: 0;
background: linear-gradient(135deg, #667eea, #764ba2);
transition: width 0.3s ease;
}
.nav-links a:hover::after {
    width: 100%;
}
.auth-buttons {
    display: flex;
    gap: 1rem;
}
.btn-login {
padding: 0.5rem 1.5rem;
border: 2px solid #667eea;
background: transparent;
color: #667eea;
border-radius: 25px;
text-decoration: none;
font-weight: 600;
transition: all 0.3s ease;
}
.btn-login:hover {
background: #667eea;
color: white;
transform: translateY(-2px);
box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}
.btn-register {
padding: 0.5rem 1.5rem;
background: linear-gradient(135deg, #667eea, #764ba2);
color: white;
border-radius: 25px;
text-decoration: none;
font-weight: 600;
transition: all 0.3s ease;
box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}
.btn-register:hover {
transform: translateY(-2px);
box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

</style>
<script src="/assets/js/app.js"></script>
