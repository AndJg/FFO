<?php 

include '../init.php';

if(isset($_POST['showImage']) && !empty($_POST['showImage'])){

    $rcmd_id =  $_POST['showImage'];
    $user_id =  $_SESSION['user_id'];
    $recommend = $getFromRec->getPopupRec($rcmd_id);
    $likes   =  $getFromRec->likes($user_id, $rcmd_id);
    ?> 
    <div class="img-popup">
    <div class="wrap6">
    <span class="colose">
        <button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
    </span>
    <div class="img-popup-wrap">
        <div class="img-popup-body">
            <img src="<?php echo BASE_URL.$recommend->rcmdImage; ?> "/>
        </div>
        <div class="img-popup-footer">
            <div class="img-popup-recommend-wrap">
                <div class="img-popup-recommend-wrap-inner">
                    <div class="img-popup-recommend-left">
                        <img src="<?php echo BASE_URL.$recommend->profilePic; ?>"/>
                    </div>
                    <div class="img-popup-recommend-right">
                        <div class="img-popup-recommend-right-headline">
                            <a href="<?php echo BASE_URL.$recommend->username; ?>"><?php echo $recommend->screenName; ?></a><span>@<?php echo $recommend->username.'-'.$recommend->postedOn; ?> - DATE-TIME</span>
                        </div>
                        <div class="img-popup-recommend-right-body">
                          <?php echo $getFromRec->getRecLinks($recommend->status);?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="img-popup-recommend-menu">
                <div class="img-popup-recommend-menu-inner">
                      <ul> 
                          <?php if($getFromUser->loggedIn() === true){
                                echo '
                                <li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
				
                                <li>'.(($likes['likeOn'] === $recommend->rcmd_id) ? '<button class="unlike-btn" data-recommend="'.$recommend->rcmd_id.'" data-user="'.$recommend->rcmd_by.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a><span class="likesCounter">'.$recommend->likesCount.'</span></button>' : '<button class="like-btn" data-recommend="'.$recommend->rcmd_id.'" data-user="'.$recommend->rcmd_by.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a><span class="likesCounter">'.(($recommend->likesCount > 0) ? $recommend->likesCount : '').'</span></button>' ).'</li>
                                    <li>

                                    <li><label for="img-popup-menu"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></label>
                                    <input id="img-popup-menu" type="checkbox"/>
                                    <div class="img-popup-footer-menu">
                                        <ul>
                                          <li><label class="deleteRecommend" >Delete Recommend</label></li>
                                        </ul>
                                    </div>
                                    </li>
                                ';
                          }else{

                            echo ' <li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>	
                           
                            <li><button class="like-btn"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter"></span></button></li>';

                          }?>
                       
                        
                     
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div><!-- Image PopUp ends-->
    <?php


}
?>