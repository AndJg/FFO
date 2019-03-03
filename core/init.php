<?php  
include 'database/connect.php';
include 'classes/user.php';
include 'classes/recommend.php';
include 'classes/follow.php';
include 'classes/message.php';
include 'classes/artist.php';
include 'classes/band.php';
global $pdo;

session_start();


$getFromUser = new User($pdo);
$getFromRec = new  Recommend($pdo);
$getFromFollow = new Follow($pdo);
$getFromMessage = new Message($pdo);
$getFromArtist = new Artist($pdo);
$getFromBand = new Band($pdo);

define("BASE_URL", "http://localhost/ffo/");


?>