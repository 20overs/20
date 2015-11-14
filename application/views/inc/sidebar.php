<?php
if($this->session->userdata('logged_in')===TRUE) {
?>
<div class="panel panel-info">
<div class="panel-heading">
	<center><span class="font-source upper"><?=$title?></span></center>
</div>
   <div class="panel-body">
		<a href="#" class="btn btn-xs btn-cust" data-target="#uploadimage" id="upload-image">CHANGE PHOTO</a>
		<span href="#" class="pull-right sess-name"><img src="<?=site_url()?>public/img/icons/user.png" class="icon-top"> <?=$this->session->userdata('name')?></span>
		<center>
			<!-- <?=site_url()?>public/img/talent.jpg -->
			<img src="<?=$this->session->userdata('image_url')?>" class="img-thumbnail img-circle" />
		</center>
		<br/>
      <ul class="list-group">
      	<li class="list-group-item" id="welcome"><img src="<?=site_url()?>public/img/icons/crossarrow.png" height="17" class="icon-top">  <a href="<?=site_url()?>user/view_profile/<?=$this->session->userdata('user_id_enc')?>">My Profile</a></li>
      	<li class="list-group-item" id="Batting History"><img src="<?=site_url()?>public/img/icons/crossarrow.png" height="17" class="icon-top"><a href="<?=site_url()?>user/batting_history">Batting History</a></li>
		<li class="list-group-item" id=""><img src="<?=site_url()?>public/img/icons/crossarrow.png" height="17" class="icon-top"><a href="<?=site_url()?>user/history">Create/Manage History</a></li>
		<li class="list-group-item" id="Articles"><img src="<?=site_url()?>public/img/icons/crossarrow.png" height="17" class="icon-top">  <a href="<?=site_url()?>user/articles">Articles</a></li>
		<li class="list-group-item" id="Forgot Profile Id"><img src="<?=site_url()?>public/img/icons/crossarrow.png" height="17" class="icon-top">  <a id="forgot-popup" data-target="#forgot" href="#">Forgot Profile Id</a></li>
		<li class="list-group-item"><img src="<?=site_url()?>public/img/icons/crossarrow.png" height="17" class="icon-top">  <a href="<?=site_url()?>user/logout" id="logout">Logout</a></li>
		</ul>
   </div>
</div>
<?php
}
?>