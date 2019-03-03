<?php 
include '../init.php';
if(isset($_POST['deleteRecommend']) && !empty($_POST['deleteRecommend'])){

  $rcmd_id =  $_POST['deleteRecommend'];
  $user_id = $_SESSION['user_id'];
  $getFromRec->delete('recommend', array('rcmd_id' => $rcmd_id, 'rcmd_by'=>$user_id ));
  
 }
if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){

    $rcmd_id =  $_POST['showPopup'];
    $user_id = $_SESSION['user_id'];
    $recommend    =  $getFromRec->getPopupRec($rcmd_id);
    ?>
    <div class="rerecommend-popup">
  <div class="wrap5">
    <div class="rerecommend-popup-body-wrap">
      <div class="rerecommend-popup-heading">
        <h3>Are you sure you want to delete this Recommend?</h3>
        <span><button class="close-rerecommend-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
      </div>
       <div class="rerecommend-popup-inner-body">
        <div class="rerecommend-popup-inner-body-inner">
          <div class="rerecommend-popup-comment-wrap">
             <div class="rerecommend-popup-comment-head">
              <img src="<?php echo BASE_URL.$recommend->profilePic ?>"/>
             </div>
             <div class="rerecommend-popup-comment-right-wrap">
               <div class="rerecommend-popup-comment-headline">
                <a>	<?php  echo $recommend ->screenName; ?></a><span>‏@<?php  echo BASE_URL.$recommend ->username.' '.$recommend->postedOn; ?> </span>
               </div>
               <div class="rerecommend-popup-comment-body">
               <?php  echo BASE_URL.$recommend ->username.' '.$recommend->rcmdImage; ?>
               </div>
             </div>
          </div>
         </div>
      </div>
      <div class="rerecommend-popup-footer"> 
        <div class="rerecommend-popup-footer-right">
          <button class="cancel-it f-btn">Cancel</button><button class="delete-it" type="submit">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>

    
    <?php

}

?> 