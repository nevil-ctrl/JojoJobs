<?php
session_start();
require_once "./config/db.php";


$titleName = "JoJobsKg"; 

require_once "./layout/header.php";
require_once "./layout/nav.php";

include"./include/categories.php";
include"./include/jobs.php";
?>
