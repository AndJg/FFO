<?php 
class Artist{
    protected $pdo;

    function __construct($pdo){

        $this->pdo = $pdo;

    }

    public function inputCheck($var){

        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripcslashes($var);

        return $var;
    }

  

    public function login($email, $password){

        

        $stm = $this->pdo->prepare("SELECT `newart_id` FROM `newart` WHERE `email`= :email AND `password`  = :password");
        $stm ->bindParam(":email", $email, PDO::PARAM_STR);
        $stm ->bindParam(":password",$password, PDO::PARAM_STR);
        $stm ->execute();

        $newart = $stm ->fetch(PDO::FETCH_OBJ);
        $count = $stm ->rowCount();


        if($count > 0){

            $_SESSION['newart_id'] = $newart ->newart_id;
            header('Location: home.php');
        }else{
            return false;
        
        }
    }

    public function register($email, $name, $password){
         
        $stm = $this->pdo->prepare("INSERT INTO `newart` (`email`, `password`, `name`, `newart_pic`) VALUES (:email, :password, :name, 'assets/images/defaultprofileimage.png')");
        $stm ->bindParam(":email", $email, PDO::PARAM_STR);
        $stm ->bindParam(":password",$password, PDO::PARAM_STR);
        $stm ->bindParam(":name", $name, PDO::PARAM_STR);
        $stm ->bindParam(":password",$password, PDO::PARAM_STR);
        $stm ->execute();


        $newart_id = $this->pdo->lastInsertId();
        $_SESSION['newart_id'] = newart_id;





    }



    public function  artistIdByArtistname($name){

        $stm = $this->pdo->prepare("SELECT `newart_id` FROM `newart` WHERE `name`= :name");
        $stm ->bindParam(":name", $name, PDO::PARAM_STR); 
        $stm ->execute();
        $user = $stm->fetch(PDO::FETCH_OBJ);
        return  $name->newart_id;

    }
    

    public function userData($newart_id){

        $stm = $this->pdo->prepare("SELECT * FROM  `newart` WHERE `newart_id` = :newart_id");
        $stm ->bindParam(":newart_id", $newart_id, PDO::PARAM_INT);
        $stm ->execute();

        return $stm ->fetch(PDO::FETCH_OBJ);

    }


    public function logout(){
        $_SESSION = array();
        session_destroy();
        header('Location: '.BASE_URL.'index.php');

    }




    public function create($table, $fields = array()){

        $columns = implode(',', array_keys($fields));
        $values  = ':'.implode(', :', array_keys($fields));
        $sql     = "INSERT {$table} ({$columns}) VALUES ({$values})";
        if($stm = $this->pdo->prepare($sql)){

            foreach ($fields as $key => $data) {
               
                $stm->bindValue(':'.$key, $data);
            }
            $stm ->execute();
            return $this->pdo->lastInsertId();

        }

    }

    
    public function update($table, $user_id, $fields = array()){

        $columns = '';
        $i       = 1;

        foreach ($fields as $name => $value) {
          
            $columns .= "`{$name}` = :{$name}";
            if($i < count($fields)){

                $columns .= ', ';
           }
           $i++;
        }

    $sql = "UPDATE {$table} SET {$columns}  WHERE `newart_id` = {$newart_id} ";

        if($stm = $this->pdo->prepare($sql)){

            foreach ($fields as $key => $value) {
                
                $stm->bindValue(':' .$key, $value);
            }

            $stm->execute();


        }

    }

    public function delete($table, $array){

    $sql = "DELETE FROM `{$table}`";
    $where = " WHERE ";


    foreach ($array as $name => $value) {

        $sql .= "{$where} `{$name}` = `:{name}` ";

        $where = " AND ";

    }

    if($stm = $this->pdo->prepare($sql)){

        foreach ($array as $name => $value) {
         
            $stm->bindValue(':'.$name, $value);
        }

    
         $stm->execute();
    }



    }

    public function nameCheck($name){
        
        $stm = $this->pdo->prepare("SELECT `name` FROM `newart` WHERE `name` = :name");
        $stm ->bindParam(":name", $name, PDO::PARAM_STR); 
        $stm ->execute();

        $count = $stm->rowCount();
        
        if(count > 0){

            return true;

        }else{

            return false;
        }
    }


    public function passwordCheck($password){
        
        $stm = $this->pdo->prepare("SELECT `password` FROM `newart` WHERE `password` = :password");
        $stm ->bindParam(":password", $password, PDO::PARAM_STR); 
        $stm ->execute();

        $count = $stm->rowCount();
        
        if(count > 0){

            return true;

        }else{

            return false;
        }
    }





    public function emailCheck($email){
        
        $stm = $this->pdo->prepare("SELECT `email` FROM `newart` WHERE `email` = :email");
        $stm ->bindParam(":email", $email, PDO::PARAM_STR); 
        $stm ->execute();

        $count = $stm->rowCount();
        
        if(count > 0){

            return true;

        }else{

            return false;
        }


    }

    public function loggedIn(){

        return(isset($_SESSION['newart_id'])) ?  true : false;


    }

    public function   userIdByName($name){

        $stm = $this->pdo->prepare("SELECT `newart_id` FROM `newart` WHERE `name`= :name");
        $stm ->bindParam(":name", $name, PDO::PARAM_STR); 
        $stm ->execute();
        $newart = $stm->fetch(PDO::FETCH_OBJ);
        return  $newart->newart_id;

    }

    public function  uploadImage($file){

        $filename = basename($file['name']);
        $fileTemp  = $file['tmp_name'];
        $fileSize  = $file['size'];
        $error     = $file['error'];

        $ext = explode('.', $filename );
        $ext = strtolower(end($ext));
        $allowed_ext = array('jpg', 'png','jpeg');

        if(in_array($ext, $allowed_ext) === true){

            if($error === 0){
                if($fileSize <= 209272152){
                    
                    $fileRoot = 'users/' . $filename;
                    move_uploaded_file($fileTemp, $_SERVER['DOCUMENT_ROOT'].'/ffo/'.$fileRoot);
                    return $fileRoot;


                }else {

                    $GLOBALS['imageError'] = "File is too big!";

                }
            }


        }else{

            $GLOBALS['imageError'] = "This extension is not allowed";

        }

    }

    public function timeAgo($datetime){

        $time = strtotime($datetime);
        $current = time();
        $seconds = $current - $time;
        $minutes = round($seconds / 60);
        $hours   = round($seconds / 3600);
        $months  = round($seconds / 200640);

        if($seconds <= 60 ){

            if($seconds == 0){

                return 'now';
            }else {
                
                return $seconds.'s';
            }

            }elseif($minutes <= 60){

                return $minutes.'m';

            }elseif ($hours <= 24) {

              return $hours.'h';  
              
            }elseif ($months <= 12) {
                
                return date('M j', $time);
            }else {
                return date('j M Y', $time);
            }
        }

   




}



?>