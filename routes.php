<?php

require_once __DIR__.'/router.php';

get('/', 'pages/index.php');

get('/login', 'auth/login.php');
any('/login','auth/login.php');

get('/registr', 'auth/register.php');
any('/registr','auth/register.php');


any('/404','pages/404.php');