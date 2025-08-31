<?php
session_start();
require_once __DIR__ . '/../../config/db.php'; 

if (empty($_SESSION['user']['id'])) {
    header("Location: /login");
    exit;
}

$userId = $_SESSION['user']['id'];

if (!empty($_FILES['avatar']['name'])) {
    $file = $_FILES['avatar'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = uniqid("avatar_") . "." . $ext;

        $uploadDir = __DIR__ . "/../../uploads/avatars/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $uploadPath = $uploadDir . $newName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {

            $stmt = $conn->prepare("SELECT avatar FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $oldAvatar = $stmt->fetchColumn();

            if ($oldAvatar && file_exists($uploadDir . $oldAvatar)) {
                unlink($uploadDir . $oldAvatar);
            }
            $stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE id = ?");
            $stmt->execute([$newName, $userId]);

            header("Location: /profile");
            exit;
        } else {
            die("Ошибка сохранения файла");
        }
    } else {
        die("Ошибка загрузки файла");
    }
} else {
    die("Файл не выбран");
}
