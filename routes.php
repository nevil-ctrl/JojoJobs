<?php
    
require_once __DIR__.'/router.php';

get('/', 'pages/index.php');

get('/login', 'auth/login.php');
any('/login','auth/login.php');

get('/registr', 'auth/register.php');
any('/registr','auth/register.php');

get('/logout', 'auth/logout.php');
any('/logout','auth/logout.php');

get('/profile', 'pages/profile/profile.php');
any('/profile', 'pages/profile/profile.php');
any('/profileUpdate', 'pages/profile/profile_update.php');

get('/avatar', 'pages/profile/upload_avatar.php');
any('/avatar','pages/profile/upload_avatar.php');



any('/404','pages/404.php');