<?php
if($this->session->userdata('logged_in')===TRUE) {
?>
<div class="panel panel-info">
<div class="panel-heading">
	<center><span class="font-source upper"><?=$title?></span></center>
</div>
   <div class="panel-body">
		<a href="<?=site_url()?>user/upload_photo" class="btn btn-xs btn-cust" data-target="#uploadimage" id="upload-image">CHANGE PHOTO</a>
		<span class="pull-right sess-name"><i class="fa fa-user"></i> <?=$this->session->userdata('name')?></span>
		<center>
			<!-- <?=site_url()?>public/img/talent.jpg -->
			<img src="<?=$this->session->userdata('image_url')?>" class="img-thumbnail img-circle" />
		</center>
		<br/>
      <ul class="list-group">
      	<li class="list-group-item" id="welcome"><i class="fa fa-mail-forward icon-top"></i>  <a href="<?=site_url()?>welcome/view_profile/<?=$this->session->userdata('pp_id_enc')?>">My Profile</a></li>
      	<li class="list-group-item" id="Batting History"><i class="fa fa-mail-forward icon-top"></i> <a href="<?=site_url()?>user/create_batting_history">Batting History</a> | <a href="<?=site_url()?>user/create_bowling_history">Bowling History</a></li>
		<li class="list-group-item" id=""><i class="fa fa-mail-forward icon-top"></i> <a href="<?=site_url()?>user/history">Create/Manage History</a></li>
		<li class="list-group-item" id="Articles"><i class="fa fa-mail-forward icon-top"></i>  <a href="<?=site_url()?>user/articles">Articles</a></li>
		<li class="list-group-item" id="Forgot Profile Id"><i class="fa fa-mail-forward icon-top"></i> <a href="<?=site_url('user/forgot_profile_id')?>">Forgot Profile ID</a></li>
		<li class="list-group-item" id="Friends"><i class="fa fa-mail-forward icon-top"></i> <a href="<?=site_url('social')?>">Friends &amp; Requests</a> <span class="badge pull-right"><?=$friend_request_count?></span></li>
		<li class="list-group-item" id="Friends"><i class="fa fa-mail-forward icon-top"></i> <a href="<?=site_url('social/notification_list')?>">Notifications <span class="badge pull-right"><?=$notification_count?></span></a></li>
		<li class="list-group-item"><i class="fa fa-mail-forward icon-top"></i> <a href="<?=site_url()?>user/create_team" id="create_a_team">Create a team</a></li>
		<li class="list-group-item"><i class="fa fa-mail-forward icon-top"></i> <a href="<?=site_url()?>user/logout" id="logout">Logout</a></li>
		</ul>
   </div>
</div>
<?php
}
?>