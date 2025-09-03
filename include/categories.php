<?php
require_once "./config/db.php";

$stmt = $conn->query("SELECT id, name FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$selectCategoryId = $_GET['category_id'] ?? '';
?>

<div class="categories">
    <?php foreach ($categories as $category): ?>
        <a href="?category_id=<?= $category['id'] ?>" class="category-card <?= ($selectedCategoryId == $category['id']) ? 'active' : '' ?>">
            <div class="category-name"><?= htmlspecialchars($category['name']) ?></div>
        </a>
    <?php endforeach; ?>
</div>