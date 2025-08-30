<?php

require_once __DIR__.'/router.php';

get('/', 'pages/index.php');

get('/register', 'auth/register.php');
any('/register','auth/register.php');

get('/login', 'auth/login.php');
any('/login','auth/login.php');


get('/logout', 'auth/logout.php');
any('/logout','auth/logout.php');


any('/404','pages/404.php');