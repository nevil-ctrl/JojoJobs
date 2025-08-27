<?php

require_once __DIR__.'/router.php';

get('/', 'pages/index.php');

get('/register', 'pages/register.php');
any('/register','pages/register.php');


any('/404','pages/404.php');