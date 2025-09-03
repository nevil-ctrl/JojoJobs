<?php
session_start();

if ($_SESSION['user']['admin'] != 1) {
    header("Location: /");
    exit;
}

// Заголовок
$titleName = 'Админ панель красавица';


?>