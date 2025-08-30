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

        <div class="profile_nav_avatar">
            <img src="#" alt="Аватар" class="avatar">
            <div class="dropdown_profile">
                <a href="/profile">Profile</a>
                <a href="/logout">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <a href="/login">Log</a>
        <a href="/registr">Reg</a>
    <?php endif; ?>
</div>


        </div>
    </div>
</nav>
<style>
    .nav_profile{
        display: flex;
        gap: 5px;
    }
.profile_nav_avatar {
    position: relative;
    cursor: pointer;
}

.dropdown_profile {
    display: none;
    position: absolute;
    top: 50px;
    right: 0;
    background: #fff;
    border: 1px solid #ccc;
    flex-direction: column;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.dropdown_profile.active {
    display: flex;
}

.dropdown_profile a {
    display: block;
    padding: 10px 20px;
    color: #333;
    text-decoration: none;
}

.dropdown_profile a:hover {
    background-color: #f0f0f0;
}



</style>

<script>
const avatar = document.querySelector('.profile_nav_avatar');
const menu = document.querySelector('.dropdown_profile');

avatar.addEventListener('click', () => {
    menu.classList.toggle('active'); 
});

</script>