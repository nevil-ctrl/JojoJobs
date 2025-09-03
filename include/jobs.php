<?php
require_once __DIR__ . '/../config/db.php';

$selectedCategoryId = $_GET['category_id'] ?? '';

$sql = "SELECT jobs.id, jobs.title, jobs.company, jobs.salary, jobs.location, categories.name AS category
        FROM jobs
        LEFT JOIN categories ON jobs.category_id = categories.id";

if ($selectedCategoryId) {
    $selectedCategoryId = (int)$selectedCategoryId;

    $sql .= " WHERE jobs.category_id = :category_id";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['category_id' => $selectedCategoryId]);
} else {
    $stmt = $conn->query($sql);
}

$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="jobs">
    <?php if ($jobs): ?>
        <?php foreach ($jobs as $job): ?>
            <div class="job-card">
                <h2><?= htmlspecialchars($job['title']) ?></h2>
                <p>Компания: <?= htmlspecialchars($job['company']) ?></p>
                <p>Локация: <?= htmlspecialchars($job['location']) ?></p>
                <p>Зарплата: <?= htmlspecialchars($job['salary']) ?></p>
                <p>Категория: <?= htmlspecialchars($job['category']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Вакансий нет</p>
    <?php endif; ?>
</div>
