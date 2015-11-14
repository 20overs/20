<ul class="collection">
	<li><h5>BEING SOCIAL !</h5></li>
	<li class="divider"></li>
	<li><a href="#" class="collection-item">NOTIFICATIONS <span class="new badge">7</span></a></li>
	<li><a href="#" class="collection-item">MATCH REQUESTS <span class="new badge">1</span></a></li>
	<li><a href="#" class="collection-item">FRIEND REQUESTS 
	<?php
	if($friend_request_count > 0){
	echo '<span class="new badge">'.$friend_request_count.'</span>';
	}
	?>
	</a></li>
	<li class="divider"></li>
	<li><a href="#" class="collection-item">CREATE MATCH SCHEDULE</a></li>
	<li class="divider"></li>
	<li><a href="#" class="collection-item">EDIT PROFILE</a></li>
	<li><a href="#" class="collection-item">SETTINGS</a></li>
	<li class="divider"></li>
	<li><a href="#" class="collection-item">LOGOUT</a></li>
</ul>