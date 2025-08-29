<?php

?>

<nav class="nav">
    <div class="nav_main">
        <a href="/">JoJoobs Kg</a>
    </div>
    <div class="nav_link">
        <a href="/">О нас</a>
        <a href="/">Наш телеграмм</a>
        <a href="/">Фильтр</a>
        <div class="nav_profile">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/logout">Logout</a>
            <?php else: ?>
                <a href="/login">Log</a>
                <a href="/registr">Reg</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
