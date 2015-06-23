<div class="panel panel-info">
<div class="panel-heading">
	<center><span class="font-source upper"><?=$title?></span></center>
</div>
   <div class="panel-body">
		<?php
		if($this->session->userdata('logged_in')===TRUE) {
		?>
		<a href="#" class="btn btn-xs btn-cust"><span class="glyphicon glyphicon-link"></span> CHANGE PHOTO</a>
		<span href="#" class="pull-right sess-name"><span class="glyphicon glyphicon-user"></span> <?=$this->session->userdata('name')?></span>
		<center>
			<img src="<?=site_url()?>public/img/talent.jpg" class="img-thumbnail img-circle" />
		</center>
		<br/>
		<?php
		}
		?>
      <ul class="list-group">
      	<li class="list-group-item glyphicon glyphicon-chevron-right" id="welcome"> <a href="<?=site_url()?>user/welcome">My Profile</a></li>
		<li class="list-group-item glyphicon glyphicon-chevron-right" id="Batting History"> <a href="<?=site_url()?>user/history">Create/Manage History</a></li>
		<li class="list-group-item glyphicon glyphicon-chevron-right" id="Articles"> <a href="<?=site_url()?>user/articles">Articles</a></li>
		<li class="list-group-item glyphicon glyphicon-chevron-right" id="Forgot Profile Id"> <a id="forgot-popup" data-target="#forgot" href="#">Forgot Profile Id</a></li>
		<?php
		if($this->session->userdata('logged_in')===TRUE){
		?>
		<li class="list-group-item glyphicon glyphicon-chevron-right" > <a  data-toggle="modal" data-target="#forgot"href="<?=site_url()?>user/logout" id="logout">Logout <span class="glyphicon glyphicon-log-out"></span> </a></li>
		<?php
		}
		?>
		</ul>
   </div>
</div>