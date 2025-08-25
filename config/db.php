<?php 
$servername = "database";
$username = "root";
$password = "root";
try{
    $conn = new PDO("mysql:host=$servername;", $username,$password );
    $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
catch(PDOException $e){};
?>