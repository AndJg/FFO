<?php


include 'core/init.php';
$connect = $pdo;

if(isset($_POST["index"], $_POST["artist_id"]))
{
 $query = "
 INSERT INTO rating(artist_id, rating) 
 VALUES (:artist_id, :rating)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':artist_id'  => $_POST["artist_id"],
   ':rating'   => $_POST["index"]
  )
 );
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'done';
 }
}


?>
