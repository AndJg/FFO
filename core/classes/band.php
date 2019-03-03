<?php 
class Band{
    protected $pdo;

    function __construct($pdo){

        $this->pdo = $pdo;

    }
   



    public function getId(){

        $stm = $this->pdo->prepare("SELECT band_id FROM  `bands`");
        $stm ->bindParam(":band_id", $band_id, PDO::PARAM_INT);
        $stm ->execute();
 
    }





    public function bandIdRock(){

        $stm = $this->pdo->prepare("SELECT * FROM  `bands` WHERE genre = 'Rock'");
        $stm->execute();
        $bands = $stm->fetchAll(PDO::FETCH_OBJ);
      
    
        foreach ($bands as $band) {
            
            echo '
         <a class="module" href="band.php?band_id='.$band->band_id.'"><h2 style="color: #000; position:absolute;  background: rgba(255, 255, 255, 0.75); ">'.$band->name.'</h2><img alt="'.$band->name.'" src="'.$band->bandPic.'" width="230" height="200"></a>
       
           ';
    

        }


    }
        
    public function bandIdProg(){

        $stm = $this->pdo->prepare("SELECT * FROM  `bands` WHERE genre = 'Prog'");
        $stm->execute();
        $bands = $stm->fetchAll(PDO::FETCH_OBJ);
      
    
        foreach ($bands as $band) {
            
            echo '
         <a class="module" href="band.php?band_id='.$band->band_id.'"><h2 style="color: #000; position:absolute;  background: rgba(255, 255, 255, 0.75); ">'.$band->name.'</h2><img alt="'.$band->name.'" src="'.$band->bandPic.'" width="230" height="200"></a>
       
           ';
    

        }
    

    } 


    public function bandIdClassical(){

        $stm = $this->pdo->prepare("SELECT * FROM  `bands` WHERE genre = 'Classical'");
        $stm->execute();
        $bands = $stm->fetchAll(PDO::FETCH_OBJ);
      
    
        foreach ($bands as $band) {
            
            echo '
         <a class="module" href="band.php?band_id='.$band->band_id.'"><h2 style="color: #000; position:absolute;  background: rgba(255, 255, 255, 0.75); ">'.$band->name.'</h2><img alt="'.$band->name.'" src="'.$band->bandPic.'" width="230" height="200"></a>
       
           ';
    

        }
    

    }






    public function bandIdJazz(){

        $stm = $this->pdo->prepare("SELECT * FROM  `bands` WHERE genre = 'Jazz'");
        $stm->execute();
        $bands = $stm->fetchAll(PDO::FETCH_OBJ);
      
    
        foreach ($bands as $band) {
            
            echo '
         <a class="module" href="band.php?band_id='.$band->band_id.'"><h2 style="color: #000; position:absolute;  background: rgba(255, 255, 255, 0.75); ">'.$band->name.'</h2><img alt="'.$band->name.'" src="'.$band->bandPic.'" width="230" height="200"></a>
       
           ';
    

        }
    

    }



    public function getTaste(){

        $stm = $this->pdo->prepare("SELECT * FROM  `bands` WHERE statusOf = 'pro' ORDER BY RAND() LIMIT 5");
        $stm->execute();
        $bands = $stm->fetchAll(PDO::FETCH_OBJ);

        foreach ($bands as $band) {
            
            echo '
    
         <a class="module" href="band.php?band_id='.$band->band_id.'"><h2 style="color: #000; position:absolute;     margin-left: -25px;  background: rgba(255, 255, 255, 0.75); ">'.$band->name.'</h2><img alt="'.$band->name.'" src="'.$band->bandPic.'" width="230" height="200"> 
        </a>
     
       
           ';

           
    
        }

        
    }


    public function getRcmdData(){

        $stm = $this->pdo->prepare("SELECT `genre`, `name`, `forrmed_in`, `inspiration` FROM  `bands` ");
        $stm->execute();

      
        $data = array();
        while($row = $stm->fetch(PDO::FETCH_ASSOC)){

            $data[] = $row;

        }

        echo json_encode($data);


    

    }







    public function lol($bandName){

        
        $stm = $this->pdo->prepare("SELECT * FROM  `users` WHERE `user_id` = :user_id");
        $stm ->execute();

        return $stm ->fetch(PDO::FETCH_OBJ);
    }

    
public function similarities(){

    $stm = $this->pdo->prepare("SELECT * FROM  `bands`  ORDER BY RAND()");
    $stm->execute();
    $bands = $stm->fetchAll(PDO::FETCH_OBJ);
  

    foreach ($bands as $band) {
        
        $bandName = $band->name;
        $bandId = $band->band_id;
        $bandStatus = $band->statusOf;
    
}
      


}


public function createBand(){

    $stm = $this->pdo->prepare("INSERT INTO `bands` (`name`, `genre`, `country`, `members`,`inspiration`,`instruments`,`bandPic`) VALUES (:name, :genre, :country, :members, :inspiration, :instruments, 'assets/images/defaultprofileimage.png')");
    $stm ->bindParam(":name", $name, PDO::PARAM_STR);
    $stm ->bindParam(":genre",$genre, PDO::PARAM_STR);
    $stm ->bindParam(":country", $country, PDO::PARAM_STR);
    $stm ->bindParam(":members",$members, PDO::PARAM_STR);
    $stm ->bindParam(":inspiration",$inspiration, PDO::PARAM_STR);
    $stm ->bindParam(":instruments",$instruments, PDO::PARAM_STR);
    $stm ->execute();


}

  
 


        
    public function bandData($band_id){

        $stm = $this->pdo->prepare("SELECT * FROM  `bands` WHERE `band_id` = :band_id");
        $stm ->bindParam(":band_id", $band_id, PDO::PARAM_INT);
        $stm ->execute();
      
        return $stm ->fetch(PDO::FETCH_OBJ);

    }


    public function discoverData(){
        $stm = $this->pdo->prepare("SELECT * FROM  `pages`");
        $stm ->execute();
     return $stm ->fetchAll(PDO::FETCH_OBJ);
     
     
    }

    public function discoverRock(){
        $stm = $this->pdo->prepare("SELECT * FROM  `bands` ORDER BY `id` WHERE `genre` = `rock`");
        $stm ->execute();
     return $stm ->fetchAll(PDO::FETCH_OBJ);
     
     
    }
    
 function getArtists(){

        
    $stm = $this->pdo->prepare("SELECT * FROM `bands` ORDER BY id DESC");
    $stm ->execute();
    $result = $stm->fetchAll();
$output = '';
foreach($result as $row)
{
 $rating = count_rating($row['band_id']);
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
  $output .= '<li title="'.$count.'" id="'.$row['band_id'].'-'.$count.'" data-index="'.$count.'"  data-band_id="'.$row['band_id'].'" data-rating="'.$rating.'" class="rating" style="cursor:pointer; '.$color.' font-size:16px;">&#9733;</li>';
 }
 $output .= '
 </ul>
 <p>'.$row["address"].'</p>
 <label style="text-danger">'.$row["bio"].'</label>
 <hr />
 ';
}
echo $output;

       
}


function count_rating($artist_id)
{
 $output = 0;
         
 $stm = $this->pdo->prepare("SELECT AVG(rating) as rating FROM rating WHERE artist_id = '".$artist_id."'");
 $stm ->execute();
 $result = $stm->fetchAll();



 $total_row = $stm->rowCount();
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output = round($row["rating"]);
  }
 }
 return $output;
}

    
}




?>