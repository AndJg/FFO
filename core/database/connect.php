<?php 

$dsn = 'mysql:host=localhost; dbname=ffo';
$user = 'root';
$pswd = '';

try{

    $pdo = new PDO($dsn, $user, $pswd);
}catch(PDOException $e){

    echo'Connection error! '.$e->getMessage();
}

?>