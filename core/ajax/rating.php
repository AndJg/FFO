<?php



include '../init.php';


$connect = $pdo;

$query = "
SELECT name, band_id, bio, genre FROM bands ORDER BY band_id ASC
";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $rating = count_rating($row['band_id'], $connect);
 $color = '';
 $output .= '
 <h3 class="text-primary">'.$row['name'].'</h3>
 <ul class="list-inline" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">
 ';
 
 for($count=1; $count<=5; $count++)
 {
  if($count <= $rating)
  {
   $color = 'color:#ffcc00;';
  }
  else
  {
   $color = 'color:#ccc;';
  }
  $output .= '<li title="'.$count.'" band_id="'.$row['band_id'].'-'.$count.'" data-index="'.$count.'"  data-artist_id="'.$row['band_id'].'" data-rating="'.$rating.'" class="rating" style="cursor:pointer; '.$color.' font-size:16px;">&#9733;</li>';
 }
 $output .= '
 </ul>
 <p>'.$row["genre"].'</p>
 <label style="text-danger">'.$row["bio"].'</label>
 <hr />
 ';
}
echo $output;

function count_rating($artist_id, $connect)
{
 $output = 0;
 $query = "SELECT AVG(rating) as rating FROM rating WHERE artist_id = '".$artist_id."'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output = round($row["rating"]);
  }
 }
 return $output;
}








?>


