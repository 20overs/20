<!DOCTYPE html>
<html>
<head>
	<title>
		<?=$title?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?=site_url()?>public/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?=site_url()?>public/css/datepicker.css" />
	<!--
	<link rel="stylesheet" href="<?=site_url()?>public/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?=site_url()?>public/css/datepicker.css" />
	-->
	<link rel="stylesheet" href="<?=site_url()?>public/css/datatable.css" />
	<link rel="stylesheet" href="<?=site_url()?>public/css/main.css" />
	<link rel="shortcut icon" href="<?=site_url()?>public/img/favicon.ico" />
</head>
<body>
<div class="container-fluid">
<div class="col-lg-4 col-md-4 col-sm-9">
	<a href="<?=site_url()?>" id="logo">
		<img src="<?=site_url()?>public/img/newlogo.png" />
	</a>
</div>
<div class="col-lg-6 col-md-6">
</div>
	
<div class="col-lg-2 col-md-2 col-sm-3">
	<div class="social-follow">
		<span>FOLLOW US:</span>
		<a href="http://www.facebook.com/20overs"><img src="<?=site_url()?>public/img/fb.png" /></a>
		<a href="http://www.twitter.com/20overs"><img src="<?=site_url()?>public/img/tweet.png" /></a>
	</div>
</div>
</div>
<div class="container-fluid">
	<div class="row">
		<nav class="navbar navbar-default nav-pills" role="navigation">
			<ul class="nav navbar-nav header-ul">
				 <li><a href="<?=site_url()?>">Home</a></li>
				 <?php
				 if($this->session->userdata('logged_in')!==TRUE){
				 ?>
				 <li><a href="<?=site_url('welcome/profile')?>">Player Profile</a></li>
				 <?php
					}else{
				 ?>
				 <li><a href="<?=site_url('user/welcome')?>">Player Profile</a></li>
				 <?php
				 }
				 ?>
				 <li><a href="<?=site_url('user/articles')?>">Articles</a></li>
				 <!--<li><a href="<?=site_url()?>">IPL 2015</a></li>-->
				 <li><a href="<?=site_url('welcome/wow')?>">Wow Catches</a></li>
				 <li><a href="<?=site_url('welcome/blind')?>">Blind Spot</a></li>
				 <?php
				if($this->session->userdata('logged_in')!==TRUE){
				?>
				 <li><a href="#" data-toggle="modal" data-target="#login-modal">Register / Login</a></li>
				<?php
				}else{
				?>
					<li><a href="<?=site_url()?>user/logout">LOGOUT</a></li>
				<?php
				}
				?>
			</ul>
		</nav>
	</div>
</div>