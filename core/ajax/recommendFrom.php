
<!-- POPUP TWEET-FORM WRAP -->
 <div class="popup-recommend-wrap">
		<div class="wrap">
		
		<div class="popwrap-inner">
			<div class="popwrap-header">
				<div class="popwrap-h-left">
					<h4>Compose new recommend</h4>
				</div>
				<span class="popwrap-h-right">
					<label class="closeRecommendPopup" for="pop-up-recommend" ><i class="fa fa-times" aria-hidden="true"></i></label>
				</span>
			</div>
			<div class="popwrap-full">
			 <form  id="popupForm" method="POST" enctype="multipart/form-data">
				<div class="popwrap-body">
				 <textarea class="status" name="status" maxlength="141" placeholder="Type Something here!" rows="4" cols="50"></textarea>
				 	<div class="hash-box">
				 		<ul>
				 		</ul>
				 	</div>
				</div>
				<div class="popwrap-footer">
				 	<div class="t-fo-left">
				 		<ul>
				 			<input type="file" name="file" id="file">
		 					<li><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label></li>
 				 		</ul>
				 	</div>
				 	<div class="t-fo-right">
			 			<span id="count">140</span>
	 					<input type="submit"  id="post" name="addRecommend" value="recommend"/>
				 	</div>
			 	</form>
				</div>
			</div>
		</div>
	</div>
</div>

